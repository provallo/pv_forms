<template>
    <div class="form-builder">
        <div class="form-items">
            <v-form-item v-for="(item, key) in sortedItems" v-model="config.items[key]"
                         :key="key" :editing="editingItem && editingItem.id === item.id"
                         :item="getAvailableItem(item.itemRef)"
                         :languageID="languageID"
                         @close="editingItem = null" @remove="remove(item)" @edit="editingItem = item"
                         @moveUp="moveUp(item)" @moveDown="moveDown(item)">
                
            </v-form-item>
        </div>
        <div class="available-items">
            <div class="header">
                Available Elements
            </div>
            <div class="item" v-for="item in availableItems" @click="addItem(item)">
                {{ item.name }}
            </div>
        </div>
    </div>
</template>

<script>
import availableItems from './form_builder/available_items'
import VFormItem from './form_builder/Item'

export default {
    components: {
        VFormItem
    },
    data() {
        return {
            editingItem: null,
            config: {
                id: 0,
                items: []
            },
            availableItems
        }
    },
    props: {
        value: {
            type: String,
            required: true
        },
        languageID: {
            type: Number,
            required: true
        },
        languages: {
            type: Array,
            required: true
        }
    },
    computed: {
        sortedItems() {
            let me = this

            return me.config.items.sort((a, b) => {
                return a.position - b.position
            })
        }
    },
    mounted() {
        let me = this

        me.readConfig()
    },
    methods: {
        readConfig() {
            let me = this

            try {
                me.config = JSON.parse(me.value)

                // todo: apply translations
            }
            catch (ex) {

            }
        },
        toString() {
            let me = this

            return JSON.stringify(me.config)
        },
        addItem(item) {
            let me = this
            let data = {
                id: ++me.config.id,
                itemRef: item.id,
                config: {},
                position: me.getPosition(),
                translations: []
            }

            me.languages.forEach(language => {
                data.translations.push({
                    languageID: language.id
                })
            })

            item.config.forEach(configEl => {
                let value = null

                switch (configEl.type) {
                    case 'text':
                        value = ''
                        break
                    case 'checkbox':
                        value = false
                        break
                    case 'list':
                        value = []
                        break
                }

                if (configEl.translatable) {
                    data.translations.forEach(translation => {
                        translation[configEl.name] = value

                        switch (configEl.type) {
                            case 'list':
                                translation[configEl.name] = []
                                break
                        }
                    })
                }

                data.config[configEl.name] = value
            })

            me.editingItem = data
            me.config.items.push(data)
        },
        getPosition() {
            let me = this
            let position = 0

            me.config.items.forEach(item => {
                position = item.position
            })

            return position + 1
        },
        getAvailableItem(id) {
            let me = this

            return me.availableItems.find(i => i.id === id)
        },
        remove(item) {
            let me = this
            let index = me.config.items.findIndex(i => i.id === item.id)

            if (index > -1) {
                me.config.items.splice(index, 1)
            }
        },
        moveUp(item) {
            let me = this
            let currentIndex = me.sortedItems.indexOf(item)

            if (currentIndex >= 1) {
                let prevItem = me.sortedItems[currentIndex - 1]
                let prevIndex = me.config.items.indexOf(prevItem)
                let thisIndex = me.config.items.indexOf(item)

                me.swapPosition(prevIndex, thisIndex)
            }
        },
        moveDown(item) {
            let me = this
            let currentIndex = me.sortedItems.indexOf(item)

            if (currentIndex < me.config.items.length) {
                let nextItem = me.sortedItems[currentIndex + 1]
                let nextIndex = me.config.items.indexOf(nextItem)
                let thisIndex = me.config.items.indexOf(item)

                me.swapPosition(nextIndex, thisIndex)
            }
        },
        swapPosition(a, b) {
            let me = this
            let aItem = me.config.items[a]
            let bItem = me.config.items[b]
            let pos = aItem.position

            aItem.position = bItem.position
            bItem.position = pos
        }
    }
}
</script>