const express = require("express");

const app = express();
const PORT = 3000;

app.get("/ejemplo", (req, res) => {
  res.json({ mensaje: "Hola desde la API en Node (Dockerfile)" });
});

app.listen(PORT, "0.0.0.0", () => {
  console.log(`Servidor escuchando en el puerto ${PORT}`);
});
