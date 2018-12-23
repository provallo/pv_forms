<template>
    <div class="is--submission-view">
        <v-grid :config="gridConfig" class="form-submissions">
            <div class="grid-item submission" slot="item" slot-scope="{ model }">
                <div class="text">{{ model.data }}</div>
                <div class="created">
                    from {{ model.created }}
                </div>
            </div>
        </v-grid>
    </div>
</template>

<script>
export default {
    props: [
        'form'
    ],
    data() {
        let me = this
        
        return {
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
                fetchParams () {
                    return {
                        id: me.form.id
                    }
                },
                columns: 1
            }
        }
    },
}
</script>