import Vue from 'vue'
import './assets/less/all.less'

export default function () {
    const {createModel} = require('@/models')
    
    ProVallo.$router.addRoutes([
        {
            name: 'form.index',
            path: '/forms',
            component: require('./views/form/Index.vue').default
        }
    ])
    
    ProVallo.$models.form = createModel(require('./models/form').default)
    ProVallo.$models.form_submission = createModel(require('./models/submission').default)
    
    Vue.component('v-form-builder', require('./modules/FormBuilder').default)
}