export default {
    fields: [
        { name: 'id', type: 'integer' },
        { name: 'label', type: 'string', filterable: true },
        { name: 'data', type: 'string' },
        { name: 'created', type: 'string' },
        { name: 'changed', type: 'string' },
    ],
    proxy: {
        list: 'backend/form/list',
        detail: 'backend/form/detail',
        save: 'backend/form/save',
        remove: 'backend/form/remove'
    }
}