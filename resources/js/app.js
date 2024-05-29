import '@tabler/core/src/js/tabler'
import.meta.glob([
    '../images/**',
    '../fonts/**',
]);
import "@tabler/icons-webfont/fonts/tabler-icons.woff"
import flatpickr from 'flatpickr';
import { French } from "flatpickr/dist/l10n/fr.js"
import "@tabler/icons-webfont/fonts/tabler-icons.woff2"
import { createApp } from 'vue/dist/vue.esm-bundler';

import MultiSelect from './components/MultiSelect.vue';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';
import Alpine from 'alpinejs'
import alertify from 'alertifyjs';
import ApexCharts from '@tabler/core/dist/libs/apexcharts/dist/apexcharts.common'

window.alertify = alertify;
window.ApexCharts = ApexCharts

window.Alpine = Alpine
Alpine.start()


document.addEventListener('DOMContentLoaded', function () {
    flatpickr("input[datetime-input]", {
        enableTime: true,
        "locale": French, // locale for this instance only,
        dateFormat: "Y-m-d H:i",
    })

    if (document.getElementById('app')) {
        const app = createApp()
        app.component('MultiSelect', MultiSelect)
        app.mount('#app')
    }

    if (document.getElementById('calendar')) {
        let calendar = new Calendar(document.getElementById('calendar'), {
            locale: frLocale,
            themeSystem: 'bootstrap5',
            plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
            initialView: 'dayGridMonth',
            events:
            {
                url: '/api/dashboard/production-plan/events',
                headers: {
                    'Content-Type': 'application/json'
                }
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            }
        });
        calendar.render();
    }

    document.querySelectorAll('a[data-confirm]').forEach((e) => {
        e.addEventListener('click', function (e) {
            e.preventDefault();
            alertify.confirm('Mars', e.target.dataset.confirm, () => {
                window.location.href = e.target.href
            }, () => alertify.error('Annulé'));
        })
    });

    document.querySelectorAll('form[data-confirm]').forEach((e) => {
        e.addEventListener('submit', function (e) {
            e.preventDefault();
            alertify.confirm('Mars', e.target.dataset.confirm, () => {
                e.target.submit();
            }, () => alertify.error('Annulé'));
        })
    });

    Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        .forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
})
