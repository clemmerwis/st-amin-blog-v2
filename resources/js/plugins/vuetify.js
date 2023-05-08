// Vuetify
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import{ aliases } from 'vuetify/iconsets/mdi';
import '@mdi/font/css/materialdesignicons.css';

export default createVuetify({
    components,
    directives,
    theme: {
        themes: {
            light: {
                dark: false,
                colors: {
                    primary: '#C3202F',
                    secondary: '#212121',
                    danger: '#c3202f',
                    error: '#c3202f',  // TODO: replace with danger
                    success: '#388E3C',
                    warning: '#FBC02D',
                    info: '#1976D2',
                    dark: '#212121',
                    light: '#EAEAEA'
                }
            },
        },
    },
    icons: {
        aliases: {
            ...aliases,
            danger: 'mdi-alert',
        },
    },
    defaults: {
        global: {
            hideDetails: 'auto',
        },
        VTextField: {
            color: 'info',
            variant: 'outlined',
            density: 'compact',
        },
        VSelect: {
            color: 'info',
            variant: 'outlined',
            density: 'compact',
        },
        VBtn: {
            size: 'small',

            VIcon: {
                size: 'small',
                start: true,
            },
        },
        VToolbar: {
            height: 60,

            VTextField: {
                bgColor: 'white',
                clearable: true,
                persistentClear: true,
            },
            VSelect: {
                bgColor: 'white',
            },
            VBtn: {
                variant: 'elevated',
            },
        },
        VDialog: {
            persistent: true,
        },
        VRadioGroup: {
            density: 'comfortable',
            color: 'info',
        },
        VTextarea: {
            color: 'info',
            variant: 'outlined',
            density: 'compact',
            autoGrow: true,
            clearable: true,
        },
        VFileInput: {
            color: 'info',
            variant: 'outlined',
            density: 'compact',
            showSize: true,
        },
        VAppBar: {
            VBtn: {
                size: 'large',
                variant: 'text',

                VIcon: {
                    size: 'large',
                    start: false,
                },
            },
        },
        VAutocomplete: {
            color: 'info',
            variant: 'outlined',
            density: 'compact',
        },
    },
});
