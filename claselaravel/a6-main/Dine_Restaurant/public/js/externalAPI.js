
// Usa el proxy Laravel definido en la vista (window.FRUITS_ENDPOINT).
// Llamar a fruityvice.com directo desde el navegador falla por CORS;
// el backend hace la petición server-to-server y reenvía el JSON.
const endPoint = window.FRUITS_ENDPOINT || '/api/fruits';

// ── Helpers ──────────────────────────────────────────────────────────────────

function mostrarCargando(containerId) {
    const el = document.getElementById(containerId);
    if (el) {
        el.innerHTML =
            '<div style="display:flex;align-items:center;justify-content:center;height:300px;color:#6c757d;">' +
            '<div class="text-center"><div class="spinner-border text-success mb-3" role="status"></div>' +
            '<p class="mb-0">Cargando datos...</p></div></div>';
    }
}

function mostrarError(containerId, mensaje) {
    const el = document.getElementById(containerId);
    if (el) {
        el.innerHTML =
            '<div style="display:flex;align-items:center;justify-content:center;height:300px;">' +
            '<div class="text-center text-danger">' +
            '<i class="bi bi-exclamation-triangle-fill fs-1 d-block mb-2"></i>' +
            '<strong>' + mensaje + '</strong></div></div>';
    }
}

// ── Función principal ─────────────────────────────────────────────────────────

function obtenerDatosYGraficar() {
    if (typeof Plotly === 'undefined') {
        mostrarError('grafico-barras', 'Plotly no está disponible. Verifica tu conexión a internet.');
        mostrarError('grafico-torta',  'Plotly no está disponible.');
        return;
    }

    mostrarCargando('grafico-barras');
    mostrarCargando('grafico-torta');

    fetch(endPoint)
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Error HTTP ' + response.status + ' al consultar la API.');
            }
            return response.json();
        })
        .then(function (frutas) {
            if (!Array.isArray(frutas) || frutas.length === 0) {
                throw new Error('La API devolvió un formato de datos inesperado.');
            }
            generarGraficoBarras(frutas);
            generarGraficoTorta(frutas, 'Banana');
        })
        .catch(function (error) {
            console.error('Hubo un fallo al cargar los gráficos:', error);
            mostrarError('grafico-barras', 'No se pudo cargar el gráfico: ' + error.message);
            mostrarError('grafico-torta',  'No se pudo cargar el gráfico: ' + error.message);
        });
}


if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', obtenerDatosYGraficar);
} else {
    obtenerDatosYGraficar();
}

// ── Gráfico de Barras ─────────────────────────────────────────────────────────

function generarGraficoBarras(listaFrutas) {
    const topCaloricas = listaFrutas
        .filter(function (f) { return f.nutritions && !isNaN(f.nutritions.calories); })
        .sort(function (a, b) { return b.nutritions.calories - a.nutritions.calories; })
        .slice(0, 7);

    if (topCaloricas.length === 0) {
        mostrarError('grafico-barras', 'No hay datos de calorías disponibles.');
        return;
    }

    const nombres  = topCaloricas.map(function (f) { return f.name; });
    const calorias = topCaloricas.map(function (f) { return f.nutritions.calories; });

    const data = [{
        x: nombres,
        y: calorias,
        type: 'bar',
        marker: {
            color: 'rgba(235, 99, 132, 0.7)',
            line: { color: 'rgba(235, 99, 132, 1)', width: 1.5 }
        }
    }];

    const layout = {
        title: 'Top 7 Frutas con Mayor Aporte Calórico (por 100g)',
        xaxis: { title: 'Frutas' },
        yaxis: { title: 'Calorías (kcal)' },
        margin: { t: 50, b: 50, l: 50, r: 50 }
    };

    Plotly.newPlot('grafico-barras', data, layout, { responsive: true });
}

// ── Gráfico de Torta ──────────────────────────────────────────────────────────

function generarGraficoTorta(listaFrutas, nombreFruta) {
    const frutaSeleccionada = listaFrutas.find(function (f) {
        return f.name.toLowerCase() === nombreFruta.toLowerCase();
    });

    if (!frutaSeleccionada) {
        console.warn('La fruta "' + nombreFruta + '" no fue encontrada.');
        mostrarError('grafico-torta', 'No se encontró la fruta "' + nombreFruta + '".');
        return;
    }

    const n = frutaSeleccionada.nutritions;

    const data = [{
        values: [n.carbohydrates, n.protein, n.fat],
        labels: ['Carbohidratos', 'Proteínas', 'Grasas'],
        type: 'pie',
        hole: 0.4,
        marker: { colors: ['#36A2EB', '#FFCE56', '#4BC0C0'] }
    }];

    const layout = {
        title: 'Composición de Macros — ' + frutaSeleccionada.name + ' (g)',
        height: 400
    };

    Plotly.newPlot('grafico-torta', data, layout, { responsive: true });
}
