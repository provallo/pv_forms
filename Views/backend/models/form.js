export default {
    fields: [
        { name: 'id', type: 'integer' },
        { name: 'label', type: 'string', filterable: true },
        { name: 'data', type: 'string' },
        { name: 'successText', type: 'string', filterable: true },
        { name: 'submissionTemplate', type: 'string', filterable: true },
        { name: 'created', type: 'string' },
        { name: 'changed', type: 'string' },
        { name: 'translations', type: 'array' }
    ],
    proxy: {
        list: 'backend/form/list',
        detail: 'backend/form/detail',
        save: 'backend/form/save',
        remove: 'backend/form/remove'
    }
}