export default {
    fields: [
        { name: 'id', type: 'integer' },
        { name: 'formID', type: 'integer' },
        { name: 'data', type: 'string', filterable: true },
        { name: 'created', type: 'string' },
        { name: 'changed', type: 'string' },
    ],
    proxy: {
        list: 'backend/submission/list',
        detail: null,
        save: null,
        remove: 'backend/submission/remove'
    }
}