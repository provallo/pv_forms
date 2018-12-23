<template>
    <div class="form-builder">
        <div class="form-items">
            <v-form-item v-for="(item, key) in config.items" v-model="config.items[key]"
                         :key="key" :editing="editingItem && editingItem.id === item.id"
                         :item="getAvailableItem(item.itemRef)"
                         @close="editingItem = null" @remove="remove(item)" @edit="editingItem = item">
                
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
    data () {
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
        }
    },
    mounted () {
        let me = this
        
        me.readConfig()
    },
    methods: {
        readConfig() {
            let me = this
            
            try {
                me.config = JSON.parse(me.value)
            } catch (ex) {
            
            }
        },
        toString () {
            let me = this
            
            return JSON.stringify(me.config)
        },
        addItem (item) {
            let me = this
            let data = {
                id: ++me.config.id,
                itemRef: item.id,
                config: {},
                position: 1
            }
            
            item.config.forEach(configEl => {
                let value = null
                
                switch (configEl.type) {
                    case 'text':
                        value = '';
                        break;
                    case 'checkbox':
                        value = false;
                        break;
                    case 'list':
                        value = [];
                        break;
                }
                
                data.config[configEl.name] = value
            })
            
            me.editingItem = data
            me.config.items.push(data)
        },
        getAvailableItem (id) {
            let me = this
            
            return me.availableItems.find(i => i.id === id)
        },
        remove (item) {
            let me = this
            let index = me.config.items.findIndex(i => i.id === item.id)
            
            if (index > -1) {
                me.config.items.splice(index, 1)
            }
        }
    }
}
</script>