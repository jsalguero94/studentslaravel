<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Cursos</h1>
                        <form @submit.prevent="addCurso" class="form-inline">
                            <div v-if="errors.length">
                                <b>Please correct the following error(s):</b>
                                <ul>
                                    <!-- <li v-for="error in errors">{{ error }}</li> -->
                                </ul>
                            </div>

                            <label for="curso" class="mr-sm-2"
                                >Nombre del curso:</label
                            >
                            <input
                                type="text"
                                class="form-control mb-2 mr-sm-2"
                                placeholder="Ingrese nombre del curso"
                                v-model="curso.Nombre"
                            />
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        v-model="curso.Active"
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
                                        <th scope="col">Nombre</th>
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
                                        v-for="(curso, i) in cursos"
                                        :key="curso.Nombre"
                                    >
                                        <td>{{ i + 1 }}</td>
                                        <td>{{ curso.Nombre }}</td>
                                        <td>{{ curso.created_at }}</td>
                                        <td>{{ curso.updated_at }}</td>
                                        <td>{{ curso.Active }}</td>

                                        <td
                                            @click="
                                                setVal(
                                                    curso.Nombre,
                                                    curso.Active
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
                                                deleteCurso(curso.Nombre)
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
                                            Editar Curso
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-inline">
                                            <input
                                                class="form-control"
                                                required
                                                disabled
                                                :value="cursoe.Nombre"
                                            />

                                            <input
                                                id="Active"
                                                class="form-check-input ml-2"
                                                type="checkbox"
                                                required
                                                v-model="cursoe.Active"
                                            />
                                            <label for="Active">Activo</label>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            @click="editCurso()"
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
            cursos: [],
            curso: {
                Nombre: "",
                Active: true
            },
            cursoe: {
                Nombre: "",
                Active: true
            },
            e_Nombre: "",
            e_Active: "",
            pagination: {},

            edit: false
        };
    },
    mounted: function mounted() {
        this.getCursos();
    },
    methods: {
        getCursos() {
            var _this = this;
            axios
                .get("/api/cursos")
                .then(function(response) {
                    _this.cursos = response.data;
                })
                .catch(error => {
                    console.log("Seleccion cursos: " + error);
                });
        },
        setVal(Nombre, Active) {
            this.cursoe.Nombre = Nombre;
            this.cursoe.Active = Active;
        },
        addCurso() {
            var input = this.curso;
            var _this = this;
            if (input["make"] == "" || input["model"] == "") {
                this.hasError = false;
            } else {
                this.hasError = true;
                axios
                    .post("/api/cursos", input)
                    .then(function(response) {
                        _this.curso = { Nombre: "", Active: true };

                        alert(
                            "Curso agregado " +
                                input.Nombre +
                                "!" +
                                response.data
                        );
                        _this.getCursos();
                        console.log(response);
                    })
                    .catch(error => {
                        console.log("Insert: " + error);
                    });
            }
        },
        editCurso: function() {
            var _this = this;
            axios.put("/api/cursos", this.cursoe).then(function(response) {
                console.log(response);

                _this.getCursos();
            });
        },
        deleteCurso: function(curso) {
            var _this = this;
            axios.delete("/api/cursos/" + curso).then(function(response) {
                console.log(response);

                _this.getCursos();
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
