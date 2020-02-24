<template>
    <v-form v-if="value"
            @submit="submit" :buttons="formButtons"
            :style="{ maxWidth: '1000px' }"
            ref="form">
        <div class="form-item" v-if="value.id > 0">
            <label for="id">
                ID
            </label>
            <v-input type="text" id="id" :value="value.id.toString()" readonly></v-input>
        </div>
        <div class="form-item">
            <label for="label">
                Label
            </label>
            <v-input type="text" id="label" v-model="getTranslated(value).label"></v-input>
        </div>
        <div class="form-item">
            <label for="successText">
                Success Text
            </label>
            <v-input type="textarea" id="successText" v-model="getTranslated(value).successText"></v-input>
        </div>
        <div class="form-item">
            <label for="submissionTemplate">
                Submission Template
            </label>
            <v-input type="textarea" id="submissionTemplate" v-model="getTranslated(value).submissionTemplate"></v-input>
        </div>
        <div class="form-item" :key="value.id">
            <v-form-builder v-model="value.data" ref="formBuilder"></v-form-builder>
        </div>
    </v-form>
</template>

<script>
export default {
    props: [
        'value',
        'grid',
        'languageID'
    ],
    data() {
        return {
            formButtons: [
                {
                    label: 'Save',
                    primary: true,
                    name: 'submit'
                }
            ]
        }
    },
    methods: {
        submit({ setMessage, setLoading, setProgress }) {
            let me = this

            me.value.data = me.$refs.formBuilder.toString()

            setLoading(true)
            me.$models.form.save(me.value).then(({ success, data, messages }) => {
                if (success) {
                    setMessage('success', 'The form were saved successfully')
                    setLoading(false)

                    me.value.id = data.id
                    me.value.translations = data.translations
                    me.grid.load()
                } else {
                    setMessage('error', messages[0])
                    setLoading(false)
                }
            }).catch(error => {
                setMessage('error', error.toString())
                setLoading(false)
            })
        },
        reset() {
            let me = this

            me.$refs.form.reset()
        },
        getTranslated (model) {
            return model.translations.find(t => t.languageID === this.languageID) || model;
        }
    }
}
</script>