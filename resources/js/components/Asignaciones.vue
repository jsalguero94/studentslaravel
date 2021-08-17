<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Asignaciones</h1>
                        <form @submit.prevent="addAsignacion" class="">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input
                                            @keydown="buscaEst"
                                            v-model="elEst"
                                            type="tex"
                                            class="form-control col-4"
                                            placeholder="Ingrese Nombre"
                                        />
                                        <div class="input-group-append">
                                            <select v-model="est_id">
                                                <option
                                                    v-for="estudiante in estudiantesn"
                                                    :key="estudiante.id"
                                                    v-bind:value="estudiante.id"
                                                >
                                                    {{
                                                        estudiante.Nombres +
                                                            " " +
                                                            estudiante.Apellidos
                                                    }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Carrera:</label>
                                    <select
                                        class="form-control mb-2 mr-sm-2"
                                        v-model="carrera_id"
                                    >
                                        <option
                                            v-for="carrera in carreras"
                                            :key="carrera.id"
                                            v-bind:value="carrera.id"
                                        >
                                            {{ carrera.Nombre }}
                                        </option>
                                    </select>
                                    <label>Curso:</label>
                                    <select
                                        class="form-control mb-2 mr-sm-2"
                                        v-model="curso_id"
                                    >
                                        <option
                                            v-for="curso in cursos"
                                            :key="curso.Nombre"
                                            v-bind:value="curso.Nombre"
                                        >
                                            {{ curso.Nombre }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Jornada:</label>
                                    <select
                                        class="form-control mb-2 mr-sm-2"
                                        required
                                        v-model="jornada"
                                    >
                                        <option>Matutina</option>
                                        <option>Vespertina</option>
                                    </select>

                                    <div class="form-check mb-2 mr-sm-2">
                                        <label class="form-check-label">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                v-model="active"
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
                                        <th scope="col">Estudiante ID</th>
                                        <th scope="col">Carreras ID</th>
                                        <th scope="col">Cursos</th>
                                        <th scope="col">Jornada</th>
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
                                        v-for="(asignacion, i) in asignaciones"
                                        :key="asignacion.id"
                                    >
                                        <td>{{ i + 1 }}</td>

                                        <td>
                                            {{
                                                selestudiante(
                                                    asignacion.Estudiantes_Id
                                                )
                                            }}
                                        </td>
                                        <td>
                                            {{
                                                selcarrera(
                                                    asignacion.Carreras_Id
                                                )
                                            }}
                                        </td>
                                        <td>
                                            {{ asignacion.Cursos }}
                                        </td>
                                        <td>{{ asignacion.Jornada }}</td>
                                        <td>{{ asignacion.created_at }}</td>
                                        <td>{{ asignacion.updated_at }}</td>
                                        <td>{{ asignacion.Active }}</td>

                                        <td
                                            @click="setVal(asignacion)"
                                            class="btn btn-info "
                                            data-toggle="modal"
                                            data-target="#myModal"
                                        >
                                            <i class="fas fa-pencil-alt"></i>
                                        </td>

                                        <td
                                            @click.prevent="
                                                deleteEstudiante(
                                                    asignacion.Estudiantes_Id
                                                )
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
                                            Editar Asignacion
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form">
                                            <label>Estudiante ID</label>
                                            <input
                                                @keydown="buscaEst"
                                                v-model="elEst"
                                                type="tex"
                                                class="form-control col-4"
                                                placeholder="Ingrese Nombre"
                                            />
                                            <div class="input-group-append">
                                                <select
                                                    v-model="
                                                        asignacione[1]
                                                            .Estudiantes_id
                                                    "
                                                >
                                                    <option
                                                        v-for="estudiante in estudiantesn"
                                                        :key="estudiante.id"
                                                        v-bind:value="
                                                            estudiante.id
                                                        "
                                                    >
                                                        {{
                                                            estudiante.Nombres +
                                                                " " +
                                                                estudiante.Apellidos
                                                        }}
                                                    </option>
                                                </select>
                                            </div>
                                            <label>Carrera:</label>
                                            <select
                                                class="form-control mb-2 mr-sm-2"
                                                v-model="
                                                    asignacione[1].Carreras_id
                                                "
                                            >
                                                <option
                                                    v-for="carrera in carreras"
                                                    :key="carrera.id"
                                                    v-bind:value="carrera.id"
                                                >
                                                    {{ carrera.Nombre }}
                                                </option>
                                            </select>
                                            <label>Curso:</label>
                                            <select
                                                class="form-control mb-2 mr-sm-2"
                                                v-model="asignacione[1].Cursos"
                                            >
                                                <option
                                                    v-for="curso in cursos"
                                                    :key="curso.Nombre"
                                                    v-bind:value="curso.Nombre"
                                                >
                                                    {{ curso.Nombre }}
                                                </option>
                                            </select>
                                            <label>Jornada:</label>
                                            <select
                                                class="form-control mb-2 mr-sm-2"
                                                required
                                                v-model="asignacione[1].Jornada"
                                            >
                                                <option>Matutina</option>
                                                <option>Vespertina</option>
                                            </select>

                                            <label for="Active">Activo</label>
                                            <input
                                                id="Active"
                                                class="form-check-input ml-2"
                                                type="checkbox"
                                                required
                                                v-model="asignacione[1].Active"
                                            />
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            @click="editAsignacion()"
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
            asignaciones: [], //para mostrar asignaciones
            estudiantes: [], //para mostrar estudiantes
            estudiantesn: [], //para mostrar est, filtrados en select
            cursos: [], //para mostrar cursos
            carreras: [], //para mostrar carreras
            asignacione: [
                {
                    //Original
                    Estudiantes_id: "",
                    Carreras_id: "",
                    Cursos: "",
                    Jornada: "",
                    Active: ""
                },
                {
                    //Datos a modificar
                    Estudiantes_id: "",
                    Carreras_id: "",
                    Cursos: "",
                    Jornada: "",
                    Active: ""
                }
            ], //para editar asignacion
            elEst: "", //Para buscar estudiante en select
            est_id: "", //Id estudiante
            carrera_id: "", //Id carrera
            curso_id: "", //Id curso
            jornada: "", //jornada
            active: true, //Activo si/no
            pagination: {}
        };
    },

    mounted: function mounted() {
        this.getEstudiantes();
        this.getCursos();
        this.getCarreras();
        this.getAsignaciones();
    },

    methods: {
        buscaEst() {
            //busca Nombre y lo muestre en select
            var _this = this;
            _this.estudiantesn = [];
            var estu = _this.estudiantes;
            var res;
            for (const estudiante in estu) {
                if (
                    estu[estudiante].Nombres.toLowerCase().indexOf(
                        _this.elEst.toLowerCase()
                    ) > -1
                ) {
                    _this.estudiantesn.push(estu[estudiante]);
                    console.log(_this.estudiantesn);
                    _this.est_id = _this.estudiantesn[0].id;
                }
            }
        },
        selestudiante(key) {
            //Busca nombre est por Id *Inner Join
            var _this = this;
            var estu = _this.estudiantes;
            var res;
            for (const estudiante in estu) {
                if (estu[estudiante].id == key) {
                    res =
                        estu[estudiante].Nombres +
                        " " +
                        estu[estudiante].Apellidos;
                }
            }
            return res;
        },
        selcarrera(key) {
            //Busca carrera por Id *Inner Join
            var _this = this;
            var estu = _this.carreras;
            var res;
            for (const estudiante in estu) {
                if (estu[estudiante].id == key) {
                    res = estu[estudiante].Nombre;
                }
            }
            return res;
        },
        getAsignaciones() {
            var _this = this;
            axios
                .get("/api/asignaciones")
                .then(function(response) {
                    _this.asignaciones = response.data;
                })
                .catch(error => {
                    console.log("Seleccion estudiantes: " + error);
                });
        },
        getEstudiantes() {
            var _this = this;
            axios
                .get("/api/estudiantesnombres")
                .then(function(response) {
                    _this.estudiantes = response.data;
                    _this.estudiantesn = _this.estudiantes;
                    _this.est_id = _this.estudiantesn[0].id;
                })
                .catch(error => {
                    console.log("Seleccion estudiantes: " + error);
                });
        },
        getCursos() {
            var _this = this;
            axios
                .get("/api/cursos")
                .then(function(response) {
                    _this.cursos = response.data;
                })
                .catch(error => {
                    console.log("Seleccion estudiantes: " + error);
                });
        },
        getCarreras() {
            var _this = this;
            axios
                .get("/api/carreras")
                .then(function(response) {
                    _this.carreras = response.data;
                })
                .catch(error => {
                    console.log("Seleccion estudiantes: " + error);
                });
        },
        setVal(asignacion) {
            var _this = this;
            _this.asignacione[0].Estudiantes_id = asignacion.Estudiantes_Id;
            _this.asignacione[0].Carreras_id = asignacion.Carreras_Id;
            _this.asignacione[0].Cursos = asignacion.Cursos;
            _this.asignacione[0].Jornada = asignacion.Jornada;
            _this.asignacione[0].Active = asignacion.Active;
            //recibe edicion
            _this.asignacione[1].Estudiantes_id = asignacion.Estudiantes_Id;
            _this.asignacione[1].Carreras_id = asignacion.Carreras_Id;
            _this.asignacione[1].Cursos = asignacion.Cursos;
            _this.asignacione[1].Jornada = asignacion.Jornada;
            _this.asignacione[1].Active = asignacion.Active;
        },
        addAsignacion() {
            var _this = this;
            var tosend = {
                Estudiantes_Id: _this.est_id,
                Carreras_Id: _this.carrera_id,
                Cursos: _this.curso_id,
                Jornada: _this.jornada,
                Active: _this.active
            };
            axios.post("/api/asignaciones", tosend).then(function(response) {
                console.log("Respuesta asignaciones: " + response);
                _this.est_id = "";
                _this.carrera_id = "";
                _this.curso_id = "";
                _this.jornada = "";
                _this.active = "";
                _this.getAsignaciones();
            });
        },
        editAsignacion: function() {
            //TODO
            var _this = this;
            var aenviar = _this.asignacione;
            var formateado = {
                Estudiantes_idor: aenviar[0].Estudiantes_id,
                Carreras_idor: aenviar[0].Carreras_id,
                Cursosor: aenviar[0].Cursos,
                Estudiantes_id: aenviar[1].Estudiantes_id,
                Carreras_id: aenviar[1].Carreras_id,
                Cursos: aenviar[1].Cursos,
                Jornada: aenviar[1].Jornada,
                Active: aenviar[1].Active
            };

            axios
                .post("/api/asignacionesupd", formateado)
                .then(function(response) {
                    console.log(typeof response);
                    //_this.asignacione = [];
                    _this.getAsignaciones();
                });
        },
        deleteEstudiante: function(id) {
            //Recibe Id estudiante y borra todas las asignaciones al estudiante
            var _this = this;
            axios.delete("/api/asignaciones/" + id).then(function(response) {
                console.log(response);

                _this.getAsignaciones();
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
