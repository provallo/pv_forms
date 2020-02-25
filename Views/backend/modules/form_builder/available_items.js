export default [
    {
        id: 1,
        name: 'Header',
        config: [
            {
                name: 'title',
                label: 'Title',
                
                main: 1,
                type: 'text',
                translatable: true
            },
            {
                name: 'css',
                label: 'Additional CSS-Classes',
                type: 'text'
            }
        ]
    },
    {
        id: 2,
        name: 'Paragraph',
        config: [
            {
                name: 'paragraph',
                label: 'Paragraph',
                
                main: 1,
                type: 'markdown',
                translatable: true
            },
            {
                name: 'css',
                label: 'Additional CSS-Classes',
                type: 'text'
            }
        ]
    },
    {
        id: 3,
        name: 'Textfield',
        config: [
            {
                name: 'required',
                label: 'Required',
                type: 'checkbox'
            },
            {
                name: 'label',
                label: 'Label',
                main: 1,
                type: 'text',
                translatable: true
            },
            {
                name: 'type',
                label: 'Type',
                type: 'select',
                store: [
                    { id: 'text',     label: 'Text'     },
                    { id: 'email',    label: 'E-Mail'   },
                    { id: 'password', label: 'Password' },
                    { id: 'number',   label: 'Number'   },
                    { id: 'textarea', label: 'Textarea' },
                ]
            },
            {
                name: 'placeholder',
                label: 'Placeholder',
                type: 'text',
                translatable: true
            },
            {
                name: 'value',
                label: 'Value',
                type: 'text',
                translatable: true
            },
            {
                name: 'css',
                label: 'Additional CSS-Classes',
                type: 'text'
            },
            {
                name: 'errorText',
                label: 'Error Text',
                type: 'text',
                translatable: true
            }
        ]
    },
    {
        id: 4,
        name: 'Select',
        config: [
            {
                name: 'required',
                label: 'Required',
                type: 'checkbox'
            },
            {
                name: 'label',
                label: 'Label',
                main: 1,
                type: 'text',
                translatable: true
            },
            {
                name: 'values',
                label: 'Values',
                type: 'list',
                translatable: true
            },
            {
                name: 'value',
                label: 'Value',
                type: 'text',
                translatable: true
            },
            {
                name: 'css',
                label: 'Additional CSS-Classes',
                type: 'text'
            },
            {
                name: 'errorText',
                label: 'Error Text',
                type: 'text',
                translatable: true
            }
        ]
    },
    {
        id: 5,
        name: 'Checkbox',
        config: [
            {
                name: 'required',
                label: 'Required',
                type: 'checkbox'
            },
            {
                name: 'checked',
                label: 'Checked',
                type: 'checkbox'
            },
            {
                name: 'label',
                label: 'Label',
                main: 1,
                type: 'text',
                translatable: true
            },
            {
                name: 'css',
                label: 'Additional CSS-Classes',
                type: 'text'
            },
            {
                name: 'errorText',
                label: 'Error Text',
                type: 'text',
                translatable: true
            }
        ]
    },
    {
        id: 6,
        name: 'Button',
        config: [
            {
                name: 'label',
                label: 'Label',
                main: 1,
                type: 'text',
                translatable: true
            },
            {
                name: 'type',
                label: 'Type',
                type: 'select',
                store: [
                    { id: 'button', label: 'Button' },
                    { id: 'submit', label: 'Submit' },
                    { id: 'reset',  label: 'Reset'  },
                ]
            },
            {
                name: 'css',
                label: 'Additional CSS-Classes',
                type: 'text'
            }
        ]
    }

]