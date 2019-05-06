<template>
    <div class="is--submission-view row">
        <v-grid :config="gridConfig" class="form-submissions" ref="grid">
            <div class="grid-item submission" slot="item" slot-scope="{ model }" @click="select(model)">
                <div class="text">{{ model.data }}</div>
                <div class="created">
                    from {{ model.created }}
                </div>
            </div>
        </v-grid>
        <div class="submission--detail-container flex">
            <div class="submission--detail" v-if="id > 0 && selectedItem">
                <div class="text">{{ selectedItem.data }}</div>
                <div class="row">
                    <div class="created flex">
                        from {{ selectedItem.created }}
                    </div>
                    
                    <v-button @click="remove(selectedItem)">
                        Remove
                    </v-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'form'
    ],
    computed: {
        selectedItem() {
            return this.$refs.grid.models.find(item => item.id === this.id)
        }
    },
    data() {
        let me = this

        return {
            id: -1,
            gridConfig: {
                model: me.$models.form_submission,
                buttons: [
                    {
                        name: 'refresh',
                        label: '',
                        icon: 'sync-alt',
                        action: 'load'
                    }
                ],
                fetchParams() {
                    return {
                        id: me.form.id
                    }
                },
                columns: 1
            }
        }
    },
    methods: {
        select(item) {
            let me = this

            me.id = item.id
        },
        remove(item) {
            let me = this

            me.$models.form_submission.remove(item).then(() => {
                me.$refs.grid.load()
            })
        }
    }
}
</script>