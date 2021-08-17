<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Estudiantes</h1>
                        <form @submit.prevent="addEstudiante" class="">
                            <div class="row">
                                <div class="col">
                                    <input
                                        type="text"
                                        required
                                        class="form-control mb-2 mr-sm-2"
                                        placeholder="Nombres"
                                        v-model="estudiante.Nombres"
                                    />
                                    <input
                                        type="text"
                                        required
                                        class="form-control mb-2 mr-sm-2"
                                        placeholder="Tipo de Identificación"
                                        v-model="estudiante.Tipo_Identificacion"
                                    />
                                    <select
                                        class="form-control"
                                        required
                                        v-model="estudiante.Sexo"
                                    >
                                        <option disabled value="">Sexo:</option>
                                        <option>M</option>
                                        <option>F</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input
                                        type="text"
                                        required
                                        class="form-control mb-2 mr-sm-2"
                                        placeholder="Apellidos"
                                        v-model="estudiante.Apellidos"
                                    />
                                    <input
                                        type="text"
                                        required
                                        class="form-control mb-2 mr-sm-2"
                                        placeholder="No. Identificación"
                                        v-model="estudiante.No_Identificacion"
                                    />

                                    <div class="row">
                                        <div class="col-8">
                                            <input
                                                type="date"
                                                required
                                                name="bday"
                                                min="1000-01-01"
                                                max="3000-12-31"
                                                class="form-control"
                                                v-model="
                                                    estudiante.Fecha_Nacimiento
                                                "
                                            />
                                        </div>
                                        <div class="col">
                                            <label>*Fecha nacimiento</label>
                                        </div>
                                    </div>
                                    <div class="form-check mb-2 mr-sm-2">
                                        <label class="form-check-label">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                v-model="estudiante.Active"
                                            />
                                            Activado
                                        </label>
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary mb-2"
                                    >
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Tipo Id</th>
                                        <th scope="col">#Identificación</th>
                                        <th scope="col">Sexo</th>
                                        <th scope="col">Fecha_Nacimiento</th>
                                        <th scope="col">Edad *calc</th>
                                        <th scope="col">Fecha creación</th>
                                        <th scope="col">
                                            Fecha de actualización
                                        </th>
                                        <th scope="col">Activo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(estudiante, i) in estudiantes"
                                        :key="estudiante.id"
                                    >
                                        <td>{{ i + 1 }}</td>
                                        <td>{{ estudiante.id }}</td>
                                        <td>
                                            {{
                                                estudiante.Nombres +
                                                    " " +
                                                    estudiante.Apellidos
                                            }}
                                        </td>
                                        <td>
                                            {{ estudiante.Tipo_Identificacion }}
                                        </td>
                                        <td>
                                            {{ estudiante.No_Identificacion }}
                                        </td>
                                        <td>{{ estudiante.Sexo }}</td>
                                        <td>
                                            {{ estudiante.Fecha_Nacimiento }}
                                        </td>
                                        <td>
                                            {{
                                                calcularEdad(
                                                    estudiante.Fecha_Nacimiento
                                                )
                                            }}
                                        </td>
                                        <td>{{ estudiante.created_at }}</td>
                                        <td>{{ estudiante.updated_at }}</td>
                                        <td>{{ estudiante.Active }}</td>

                                        <td
                                            @click="setVal(estudiante)"
                                            class="btn btn-info "
                                            data-toggle="modal"
                                            data-target="#myModal"
                                        >
                                            <i class="fas fa-pencil-alt"></i>
                                        </td>

                                        <td
                                            @click.prevent="
                                                deleteEstudiante(estudiante.id)
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
                                            Editar Estudiante
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form">
                                            <label>ID</label>
                                            <input
                                                class="form-control"
                                                required
                                                disabled
                                                :value="estudiantee.id"
                                            />
                                            <label>Nombres</label>
                                            <input
                                                class="form-control"
                                                required
                                                v-model="estudiantee.Nombres"
                                            />
                                            <label>Apellidos</label>
                                            <input
                                                class="form-control"
                                                required
                                                v-model="estudiantee.Apellidos"
                                            />
                                            <label>Tipo Identificación</label>
                                            <input
                                                class="form-control"
                                                required
                                                v-model="
                                                    estudiantee.Tipo_Identificacion
                                                "
                                            />
                                            <label>No. Identificación</label>
                                            <input
                                                class="form-control"
                                                required
                                                v-model="
                                                    estudiantee.No_Identificacion
                                                "
                                            />
                                            <label>Sexo</label>
                                            <select
                                                class="form-control"
                                                v-model="estudiantee.Sexo"
                                            >
                                                <option disabled value=""
                                                    >Sexo:</option
                                                >
                                                <option>M</option>
                                                <option>F</option>
                                            </select>
                                            <label>Fecha nacimiento</label>
                                            <input
                                                type="date"
                                                name="bday"
                                                min="1000-01-01"
                                                max="3000-12-31"
                                                class="form-control"
                                                v-model="
                                                    estudiantee.Fecha_Nacimiento
                                                "
                                            />
                                            <label for="Active">Activo</label>
                                            <input
                                                id="Active"
                                                class="form-check-input ml-2"
                                                type="checkbox"
                                                required
                                                v-model="estudiantee.Active"
                                            />
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            @click="editEstudiante()"
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
            estudiantes: [],
            estudiante: {
                Nombres: "",
                Apellidos: "",
                Tipo_Identificacion: "",
                No_Identificacion: "",
                Sexo: "",
                Fecha_Nacimiento: "",
                Active: true
            },
            estudiantee: {
                id: "",
                Nombres: "",
                Apellidos: "",
                Tipo_Identificacion: "",
                No_Identificacion: "",
                Sexo: "",
                Fecha_Nacimiento: "",
                Active: true
            },
            pagination: {}
        };
    },
    mounted: function mounted() {
        this.getEstudiantes();
    },

    methods: {
        calcularEdad(cumple) {
            var today = new Date();
            var birthDate = new Date(cumple);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        },
        getEstudiantes() {
            var _this = this;
            axios
                .get("/api/estudiantes")
                .then(function(response) {
                    _this.estudiantes = response.data;
                })
                .catch(error => {
                    console.log("Seleccion estudiantes: " + error);
                });
        },
        setVal(estudiante) {
            var _this = this;
            _this.estudiantee.id = estudiante.id;
            _this.estudiantee.Nombres = estudiante.Nombres;
            _this.estudiantee.Apellidos = estudiante.Apellidos;
            _this.estudiantee.Tipo_Identificacion =
                estudiante.Tipo_Identificacion;
            _this.estudiantee.No_Identificacion = estudiante.No_Identificacion;
            _this.estudiantee.Sexo = estudiante.Sexo;
            _this.estudiantee.Fecha_Nacimiento = estudiante.Fecha_Nacimiento;
            _this.estudiantee.Active = estudiante.Active;
        },
        addEstudiante() {
            var input = this.estudiante;
            var _this = this;

            axios
                .post("/api/estudiantes", input)
                .then(function(response) {
                    _this.estudiante = {
                        Nombres: "",
                        Apellidos: "",
                        Tipo_Identificacion: "",
                        No_Identificacion: "",
                        Sexo: "",
                        Fecha_Nacimiento: "",
                        Active: true
                    };

                    _this.getEstudiantes();
                    console.log(response);
                })
                .catch(error => {
                    console.log("Insert: " + error);
                });
        },
        editEstudiante: function() {
            var _this = this;
            axios
                .put("/api/estudiantes", this.estudiantee)
                .then(function(response) {
                    console.log(response);

                    _this.getEstudiantes();
                });
        },
        deleteEstudiante: function(id) {
            var _this = this;
            axios.delete("/api/estudiantes/" + id).then(function(response) {
                console.log(response);

                _this.getEstudiantes();
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
