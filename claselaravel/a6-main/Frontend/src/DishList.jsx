import { useEffect, useState } from "react";
import api from "./services/api";

function DishList() {

    const [dishes, setDishes] = useState([]);

    const [name, setName] = useState("");
    const [price, setPrice] = useState("");

    const [editingDish, setEditingDish] = useState(null);

    const [editName, setEditName] = useState("");
    const [editPrice, setEditPrice] = useState("");

    useEffect(() => {

        getDishes();

    }, []);

    const getDishes = async () => {

        try {

            const response = await api.get("/dishes");

            setDishes(response.data);

        } catch (error) {

            console.error(error);

        }
    };

    const createDish = async (e) => {

        e.preventDefault();

        try {

            await api.post("/dishes", {

                name: name,
                description: "Plato creado desde React",
                price: price,
                available: true,
                category_id: 1

            });

            getDishes();

            setName("");
            setPrice("");

        } catch (error) {

            console.error(error);

        }
    };

    const deleteDish = async (id) => {

        try {

            await api.delete(`/dishes/${id}`);

            getDishes();

        } catch (error) {

            console.error(error);

        }
    };

    const openEditModal = (dish) => {

        setEditingDish(dish);

        setEditName(dish.name);

        setEditPrice(dish.price);
    };

    const updateDish = async () => {

        try {

            await api.put(`/dishes/${editingDish.id}`, {

                name: editName,
                description: editingDish.description,
                price: editPrice,
                available: editingDish.available,
                category_id: editingDish.category_id

            });

            getDishes();

            setEditingDish(null);

        } catch (error) {

            console.error(error);

        }
    };

    return (

        <div className="container mt-5">

            <h1 className="mb-4">Lista de Platos</h1>

            <form onSubmit={createDish} className="mb-4">

                <div className="row">

                    <div className="col">

                        <input
                            type="text"
                            className="form-control"
                            placeholder="Nombre"
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                        />

                    </div>

                    <div className="col">

                        <input
                            type="number"
                            className="form-control"
                            placeholder="Precio"
                            value={price}
                            onChange={(e) => setPrice(e.target.value)}
                        />

                    </div>

                    <div className="col">

                        <button className="btn btn-success w-100">
                            Guardar
                        </button>

                    </div>

                </div>

            </form>

            <table className="table table-bordered">

                <thead className="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Disponible</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    {dishes.map((dish) => (

                        <tr key={dish.id}>

                            <td>{dish.id}</td>

                            <td>{dish.name}</td>

                            <td>${dish.price}</td>

                            <td>
                                {dish.available ? "Sí" : "No"}
                            </td>

                            <td>

                                <div className="d-flex gap-2">

                                    <button
                                        className="btn btn-warning btn-sm"
                                        onClick={() => openEditModal(dish)}
                                    >
                                        Editar
                                    </button>

                                    <button
                                        className="btn btn-danger btn-sm"
                                        onClick={() => deleteDish(dish.id)}
                                    >
                                        Eliminar
                                    </button>

                                </div>

                            </td>

                        </tr>

                    ))}

                </tbody>

            </table>

            {editingDish && (

                <div className="modal d-block" tabIndex="-1">

                    <div className="modal-dialog">

                        <div className="modal-content">

                            <div className="modal-header">

                                <h5 className="modal-title">
                                    Editar Plato
                                </h5>

                                <button
                                    className="btn-close"
                                    onClick={() => setEditingDish(null)}
                                ></button>

                            </div>

                            <div className="modal-body">

                                <input
                                    type="text"
                                    className="form-control mb-3"
                                    value={editName}
                                    onChange={(e) => setEditName(e.target.value)}
                                />

                                <input
                                    type="number"
                                    className="form-control"
                                    value={editPrice}
                                    onChange={(e) => setEditPrice(e.target.value)}
                                />

                            </div>

                            <div className="modal-footer">

                                <button
                                    className="btn btn-secondary"
                                    onClick={() => setEditingDish(null)}
                                >
                                    Cerrar
                                </button>

                                <button
                                    className="btn btn-primary"
                                    onClick={updateDish}
                                >
                                    Guardar cambios
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            )}

        </div>
    );
}

export default DishList;