<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Carreras</h1>
                        <form @submit.prevent="addCarrera" class="form-inline">
                            <div v-if="errors.length">
                                <b>Please correct the following error(s):</b>
                                <ul>
                                    <!-- <li v-for="error in errors">{{ error }}</li> -->
                                </ul>
                            </div>

                            <label for="curso" class="mr-sm-2"
                                >Nombre de carrera:</label
                            >
                            <input
                                type="text"
                                class="form-control mb-2 mr-sm-2"
                                placeholder="Ingrese nombre de la carrera"
                                v-model="carrera.Nombre"
                            />
                            <label for="curso" class="mr-sm-2"
                                >Nombre de facultad:</label
                            >
                            <input
                                type="text"
                                class="form-control mb-2 mr-sm-2"
                                placeholder="Ingrese nombre de facultad"
                                v-model="carrera.Facultad"
                            />
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        v-model="carrera.Active"
                                    />
                                    Activado
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">
                                Guardar
                            </button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Carrera</th>
                                        <th scope="col">Facultad</th>
                                        <th scope="col">Fecha de creación</th>
                                        <th scope="col">
                                            Fecha de actualización
                                        </th>
                                        <th scope="col">Activo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(carrera, i) in carreras"
                                        :key="carrera.id"
                                    >
                                        <td>{{ i + 1 }}</td>
                                        <td>{{ carrera.id }}</td>
                                        <td>{{ carrera.Nombre }}</td>
                                        <td>{{ carrera.Facultad }}</td>
                                        <td>{{ carrera.created_at }}</td>
                                        <td>{{ carrera.updated_at }}</td>
                                        <td>{{ carrera.Active }}</td>

                                        <td
                                            @click="
                                                setVal(
                                                    carrera.id,
                                                    carrera.Nombre,
                                                    carrera.Facultad,
                                                    carrera.Active
                                                )
                                            "
                                            class="btn btn-info "
                                            data-toggle="modal"
                                            data-target="#myModal"
                                        >
                                            <i class="fas fa-pencil-alt"></i>
                                        </td>

                                        <td
                                            @click.prevent="
                                                deleteCarrera(carrera.id)
                                            "
                                            class="btn btn-danger "
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button
                                            type="button"
                                            class="close"
                                            data-dismiss="modal"
                                        >
                                            &times;
                                        </button>
                                        <h4 class="modal-title">
                                            Editar Carrera
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form">
                                            <label>ID</label>
                                            <input
                                                class="form-control"
                                                required
                                                disabled
                                                :value="carrerae.id"
                                            />
                                            <label>Nombre</label>
                                            <input
                                                class="form-control"
                                                required
                                                v-model="carrerae.Nombre"
                                            />
                                            <label>Facultad</label>
                                            <input
                                                class="form-control"
                                                required
                                                v-model="carrerae.Facultad"
                                            />
                                            <label for="Active">Activo</label>
                                            <input
                                                id="Active"
                                                class="form-check-input ml-2"
                                                type="checkbox"
                                                required
                                                v-model="carrerae.Active"
                                            />
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            @click="editCarrera()"
                                            data-dismiss="modal"
                                        >
                                            Guardar cambios
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-dismiss="modal"
                                        >
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            carreras: [],
            carrera: {
                Nombre: "",
                Facultad: "",
                Active: true
            },
            carrerae: {
                id: "",
                Nombre: "",
                Facultad: "",
                Active: true
            },
            pagination: {},

            edit: false
        };
    },
    mounted: function mounted() {
        this.getCarreras();
    },
    methods: {
        getCarreras() {
            var _this = this;
            axios
                .get("/api/carreras")
                .then(function(response) {
                    _this.carreras = response.data;
                })
                .catch(error => {
                    console.log("Seleccion carreras: " + error);
                });
        },
        setVal(id, Nombre, Facultad, Active) {
            this.carrerae.id = id;
            this.carrerae.Nombre = Nombre;
            this.carrerae.Facultad = Facultad;
            this.carrerae.Active = Active;
        },
        addCarrera() {
            var input = this.carrera;
            var _this = this;

            axios
                .post("/api/carreras", input)
                .then(function(response) {
                    _this.carrera = {
                        Nombre: "",
                        Facultad: "",
                        Active: true
                    };

                    _this.getCarreras();
                    console.log(response);
                })
                .catch(error => {
                    console.log("Insert: " + error);
                });
        },
        editCarrera: function() {
            var _this = this;
            axios.put("/api/carreras", this.carrerae).then(function(response) {
                console.log(response);

                _this.getCarreras();
            });
        },
        deleteCarrera: function(id) {
            var _this = this;
            axios.delete("/api/carreras/" + id).then(function(response) {
                console.log(response);

                _this.getCarreras();
            });
        }
    }
};
</script>

<style>
.back {
    background-color: rgb(255, 255, 255);
}
</style>
