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
            <v-form v-if="editingModel"
                    @submit="submit" :buttons="formButtons"
                    :style="{ maxWidth: '1000px' }"
                    ref="form">
                <div class="form-item" v-if="editingModel.id > 0">
                    <label for="id">
                        ID
                    </label>
                    <v-input type="text" id="id" :value="editingModel.id.toString()" readonly></v-input>
                </div>
                <div class="form-item">
                    <label for="label">
                        Label
                    </label>
                    <v-input type="text" id="label" v-model="editingModel.label"></v-input>
                </div>
                <div class="form-item">
                    <v-form-builder v-model="editingModel.data" ref="formBuilder"></v-form-builder>
                </div>
            </v-form>
        </v-detail>
    </div>
</template>

<script>
export default {
    data() {
        let me = this
        
        return {
            gridConfig: {
                model: me.$models.form
            },
            formButtons: [
                {
                    label: 'Save',
                    primary: true,
                    name: 'submit'
                }
            ],
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
        submit ({ setMessage, setLoading, setProgress }) {
            let me = this
            
            me.editingModel.data = me.$refs.formBuilder.toString()
            
            setLoading(true)
            me.$models.form.save(me.editingModel).then(({ success, data, messages }) => {
                if (success) {
                    setMessage('success', 'The form were saved successfully')
                    setLoading(false)
                    
                    me.editingModel.id = data.id
                    me.$refs.grid.load()
                } else {
                    setMessage('error', messages[0])
                    setLoading(false)
                }
            }).catch(error => {
                setMessage('error', error.toString())
                setLoading(false)
            })
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