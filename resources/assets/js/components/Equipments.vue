<template>
  <div id="equipments">
    <img :src="loading" alt="no-image" class="loading-img" v-show="this.loadstate">
    <section class="content-header">
      <h1>
        Equipos
        <small>Administrar</small>
      </h1>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-7">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-truck"></i> Equipos</h3>

                <button type="button" class="btn btn-xs btn-default pull-right" @click="fillEquipments()">
                  <i class="fa fa-refresh"></i>
                </button>
              </div>
              <div class="box-content">
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group" id="search">
                      <input type="text" class="form-control" placeholder="Buscar" v-model="criteria" disabled>
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-default" @click="criteria = '' ">
                          <i class="fa fa-trash"></i>
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Código</th>
                      <th>Controles</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(val, index) in filtered">
                      <td> <input type="text" v-model="val.name" class="form-control" :disabled="!val.editabled"></td>
                      <td> <input type="text" v-model="val.code" class="form-control" :disabled="!val.editabled" style="text-transform: uppercase;"></td>
                      <td>
                        <button type="button" class="btn btn-success btn-sm" v-show="val.editabled" @click="updateEquipment(val)">
                          <i class="fa fa-floppy-o"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" @click="turnEditabled(val)" :disabled="val.editabled">
                          <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" @click="deleteEquipment(val, index)" :disabled="val.editabled">
                          <i class="fa fa-close"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="box">
              <div class="box-header with-title">
                <h3 class="box-title"><i class="fa fa-plus-circle"></i> Agregar Equipo</h3>
              </div>
              <div class="box-content">
                <div class="container-fluid">
                  <div class="row">
                    <form class="form form-horizontal">
                      <div class="form-group">
                        <label for="" class="control-label col-md-3">Nombre</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control"  placeholder="Nombre" v-model="input.name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="" class="control-label col-md-3">Código</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control" placeholder="Código" v-model="input.code" style="text-transform: uppercase">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="" class="control-label col-md-3"></label>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-default" @click="clearInput">
                            Limpiar
                            <i class="fa fa-trash-o"></i>
                          </button>
                          <button type="button" class="btn btn-primary" @click="saveEquipment">
                            Agregar
                            <i class="fa fa-plus-circle"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  name: 'equipments',
  data: () => ({
    criteria: '',
    loadstate: false,
    equipments: [],
    input: {code: '', name: ''}
  }),
  props: {
    url: {type: String, required: true},
    loading: {type: String, required: true},
    permissions: {type: Object, required: true}
  },
  computed: {
    filtered() {
      return this.equipments.filter(callback => {
        return (callback.name.toLowerCase().indexOf(this.criteria.toLowerCase())) !== -1 ||
          (callback.code.toUpperCase().indexOf(this.criteria.toUpperCase()) !== -1)
      })
    }
  },
  methods: {
    turnLoad() {
      this.loadstate = !this.loadstate
    },
    turnEditabled(val) {
      val.editabled = !val.editabled
    },
    clearInput() {
      this.input.name = ''
      this.input.code = ''
    },
    fillEquipments() {
      if ((this.permissions.find(cb => {
        return cb.name === 'list equipment_types'
      }))) {
        this.turnLoad()
        axios.get(this.url+'/api/equipmenttypes').then(res => {
          this.equipments = []
          res.data.forEach(dt => {
            this.equipments.push({id: dt.id, name: dt.name, code: dt.code, editabled: false})
          })
        }).catch(er => {
          alert(er)
        })
        this.turnLoad()
      } else {
        alert('No tiene privilegios para listar equipos')
      }
    },
    saveEquipment() {
      if ((this.permissions.find(cb => {
        return cb.name === 'create equipment_types'
      }))){
        if (this.input.name.trim() != '' && this.input.code.trim() != '') {
          this.turnLoad()
          axios.post(this.url+'/api/equipmenttypes', {name: this.input.name, code: this.input.code.toUpperCase()}).then(res => {
            switch (res.data) {
              case 'duplicate':
                alert('Ya existe un equipo con este código')
                break
              default:
                this.equipments.push({id: res.data.id, name: res.data.name, code: res.data.code, editabled: false })
            }
            this.clearInput()
          }).catch(er => {
            alert(er)
            location.reload()
          })
          this.turnLoad()
        } else {
          alert('Antes rellene los campos: Nombre y Código')
        }
      } else {
        alert('No tiene privilegios para create nuevos equipos')
      }
    },
    updateEquipment(val) {
      if ((this.permissions.find(cb => {
        return cb.name === 'edit equipment_types'
      }))) {
        if (val.name.trim() != '' || val.code.trim() != '') {
          this.turnLoad()
          axios.put(this.url+'/api/equipmenttypes/'+val.id, {
            name: val.name, code: val.code.toUpperCase()
          }).then(res => {
            this.turnEditabled(val)
          }).catch(er => {
            alert(er)
            location.reload()
          })
          this.turnLoad()
        } else {
          alert('El campo nombre o código no pueden estar vacios')
        }
      } else {
        alert('No tiene privilegios para editar equipos')
      }
    },
    deleteEquipment(val, index) {
      if ((this.permissions.find(cb => {
        return cb.name === 'delete equipment_types'
      }))) {
        if (confirm('Desea borrar este registro')) {
          this.turnLoad()
          axios.delete(this.url+'/api/equipmenttypes/'+val.id).then(res => {
            switch (res.data) {
              case true:
                this.equipments.splice(index, 1)
                break;
              case 'unique':
                alert('Otros campos dependen de este, primero borre las dependencias')
                break;
            }
          }).catch(er => {
            alert(er)
            location.reload()
          })
          this.turnLoad()
        }
      } else {
        alert('No tiene privilegios para eliminar equipos')
      }
    }
  },
  created() {
    this.fillEquipments()
  }
}
</script>
<style scoped>

  .loading-img {
    position: fixed;
    right:10px;
    top:30px;
    margin:10px;
    display: block;
    width:120px;
    height:120px;
    z-index: 9999;
  }

  #search {
    margin: 10px !important;
  }

</style>
