<template>
    <div class="is--page-view view">
        <v-grid ref="grid" :config="gridConfig" @create="create">
            <div class="grid-item user" slot="item" slot-scope="{ model }"
                 :class="{ active: editingModel && editingModel.id === model.id }">
                <div class="item-meta" @click="edit(model)">
                    <div class="item-label">
                        {{ model.label }}
                    </div>
                </div>
                <div class="item-actions">
                    <div class="item-action" @click="remove(model)">
                        <fa icon="trash"></fa>
                    </div>
                </div>
            </div>
        </v-grid>
        <v-detail :disabled="!editingModel">
            <v-tab-menu v-if="editingModel" :key="editingModel.id">
                <v-tab id="detail" label="Detail">
                     <v-form-form v-model="editingModel" :grid="$refs.grid" ref="form"></v-form-form>
                </v-tab>
                <v-tab id="submission" label="Submissions" v-if="editingModel.id > 0" class="submission-tab">
                    <v-submissions :form="editingModel"></v-submissions>
                </v-tab>
            </v-tab-menu>
        </v-detail>
    </div>
</template>

<script>
import VFormForm from './Form'
import VSubmissions from './Submissions'

export default {
    components: {
        VFormForm,
        VSubmissions
    },
    data() {
        let me = this
        
        return {
            gridConfig: {
                model: me.$models.form
            },
            editingModel: null
        }
    },
    mounted () {
        let me = this
    
        
    },
    methods: {
        create () {
            let me = this
            
            me.editingModel = me.$models.form.create()
            me.$nextTick(() => me.$refs.form.reset())
        },
        edit (model) {
            let me = this
            
            me.editingModel = model
            me.$nextTick(() => me.$refs.form.reset())
        },
        remove (model) {
            let me = this
            
            me.$models.form.remove(model).then((success) => {
                if (success) {
                    me.$refs.grid.load()
                    
                    if (me.editingModel && me.editingModel.id === model.id) {
                        me.editingModel = null
                    }
                } else {
                    me.$swal({
                        type: 'error',
                        title: 'Sorry!',
                        text: 'Unfortunately you are not allowed to delete this form.'
                    })
                }
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>