<template>
    <div class="item">
        <div class="item-label">
            <div class="item-id">
                {{ value.id }}
            </div>
            {{ label }}
        </div>
        <ul class="item-actions">
            <li @click="moveUp">
                <fa icon="chevron-up"></fa>
            </li>
            <li @click="moveDown">
                <fa icon="chevron-down"></fa>
            </li>
            <li @click="edit">
                <fa icon="pencil-alt"></fa>
            </li>
            <li @click="remove">
                <fa icon="trash"></fa>
            </li>
        </ul>
        <div class="item-editor" v-if="editing">
            <div class="form-item" v-for="item in item.config">
                <template v-if="item.type === 'text'">
                    <label :for="item.name">
                        {{ item.label }}
                    </label>
                    <v-input type="text" :id="item.name"
                             v-model="getTranslated(item)[item.name]" />
                </template>
                <template v-else-if="item.type === 'textarea'">
                    <label :for="item.name">
                        {{ item.label }}
                    </label>
                    <v-input type="textarea" :id="item.name"
                             v-model="getTranslated(item)[item.name]" />
                </template>
                <template v-else-if="item.type === 'markdown'">
                    <label :for="item.name">
                        {{ item.label }}
                        <small>
                            (<a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet" target="_blank">Markdown</a> is supported)
                        </small>
                    </label>
                    <v-input type="textarea" :id="item.name"
                             v-model="getTranslated(item)[item.name]"
                             class="is--markdown" />
                </template>
                <template v-else-if="item.type === 'checkbox'">
                    <v-checkbox :name="item.name" :label="item.label"
                                v-model="getTranslated(item)[item.name]" />
                </template>
                <template v-else-if="item.type === 'select'">
                    <label :for="item.name">
                        {{ item.label }}
                    </label>
                    <v-select :data="item.store" displayField="label" valueField="id"
                              v-model="getTranslated(item)[item.name]" />
                </template>
                <template v-else-if="item.type === 'list'">
                    <label :for="item.name">
                        {{ item.label }}
                    </label>
                    <v-list v-model="getTranslated(item)[item.name]" />
                </template>
                <template v-else>
                    Unknown type
                </template>
            </div>
            
            <div class="editor-close" @click="close">
                Close
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: Object,
            required: true
        },
        editing: {
            type: Boolean
        },
        item: {
            type: Object,
            required: true
        },
        languageID: {
            type: Number,
            required: true
        }
    },
    computed: {
        label () {
            let me = this
            let main = me.item.config.find(c => c.main === 1)
            let values = null
            
            if (main && (values = me.getTranslated(main))) {
                return me.item.name + ': ' + values[main.name]
            }
            
            return 'Unnamed ' + me.item.name
        },
    },
    methods: {
        close () {
            let me = this
            
            me.$emit('close')
        },
        remove () {
            let me = this
            
            me.$emit('remove')
        },
        edit () {
            let me = this
            
            me.$emit('edit')
        },
        moveUp () {
            let me = this
            
            me.$emit('moveUp')
        },
        moveDown () {
            let me = this
            
            me.$emit('moveDown')
        },
        getTranslated (item) {
            if (item.translatable) {
                return this.value.translations
                    .find(t => t.languageID === this.languageID) || this.value.config
            }
            
            return this.value.config
        }
    }
}
</script>