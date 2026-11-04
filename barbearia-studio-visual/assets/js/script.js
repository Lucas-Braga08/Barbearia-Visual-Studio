'use strict';

document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', () => {
            const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', String(!isOpen));
            menuToggle.setAttribute('aria-label', isOpen ? 'Abrir menu' : 'Fechar menu');
            mainNav.classList.toggle('is-open', !isOpen);
        });

        mainNav.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Abrir menu');
                mainNav.classList.remove('is-open');
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Abrir menu');
                mainNav.classList.remove('is-open');
            }
        });
    }

    const yearElement = document.querySelector('#current-year');
    if (yearElement) {
        yearElement.textContent = String(new Date().getFullYear());
    }

    const appointmentForm = document.querySelector('#appointment-form');
    if (appointmentForm) {
        const dateInput = appointmentForm.querySelector('#appointment-date');
        const feedback = document.querySelector('#appointment-feedback');

        // Impede a seleção de datas passadas usando a data local do navegador.
        if (dateInput) {
            const now = new Date();
            const localToday = [
                now.getFullYear(),
                String(now.getMonth() + 1).padStart(2, '0'),
                String(now.getDate()).padStart(2, '0'),
            ].join('-');
            dateInput.min = localToday;
        }

        appointmentForm.addEventListener('submit', (event) => {
            event.preventDefault();

            if (!appointmentForm.reportValidity()) {
                return;
            }

            const phoneNumber = (appointmentForm.dataset.whatsappNumber || '').replace(/\D/g, '');
            if (phoneNumber.length < 10 || phoneNumber.length > 15) {
                if (feedback) {
                    feedback.textContent = 'O WhatsApp da barbearia ainda não foi configurado. Atualize o número em config/site.php.';
                }
                return;
            }

            const formData = new FormData(appointmentForm);
            const name = String(formData.get('nome') || '').trim();
            const service = String(formData.get('servico') || '').trim();
            const date = String(formData.get('data') || '').split('-').reverse().join('/');
            const time = String(formData.get('horario') || '').trim();
            const note = String(formData.get('observacao') || '').trim();

            const lines = [
                'Olá! Gostaria de solicitar um agendamento.',
                '',
                'Nome: ' + name,
                'Serviço: ' + service,
                'Dia desejado: ' + date,
                'Horário desejado: ' + time,
            ];

            if (note) {
                lines.push('Observação: ' + note);
            }

            lines.push('', 'Poderiam confirmar se esse horário está disponível? Sei que a solicitação só fica confirmada após a resposta da barbearia.');

            const url = 'https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent(lines.join('\n'));
            window.open(url, '_blank', 'noopener,noreferrer');

            if (feedback) {
                feedback.textContent = 'O WhatsApp foi aberto. Revise a mensagem e toque em enviar para concluir sua solicitação.';
            }
        });
    }

    const contactForm = document.querySelector('#contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (event) => {
            event.preventDefault();

            if (!contactForm.reportValidity()) {
                return;
            }

            const phoneNumber = (contactForm.dataset.whatsappNumber || '').replace(/\D/g, '');
            const feedback = document.querySelector('#form-feedback');

            if (phoneNumber.length < 10) {
                if (feedback) {
                    feedback.textContent = 'O WhatsApp ainda não foi configurado. Entre em contato por outro canal.';
                }
                return;
            }

            const formData = new FormData(contactForm);
            const name = String(formData.get('nome') || '').trim();
            const service = String(formData.get('servico') || '').trim();
            const message = String(formData.get('mensagem') || '').trim();

            const lines = [
                'Olá! Meu nome é ' + name + '.',
                'Tenho interesse em: ' + service + '.',
            ];

            if (message) {
                lines.push('Mais informações: ' + message);
            }

            lines.push('Gostaria de consultar os horários disponíveis.');
            const url = 'https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent(lines.join('\n'));
            window.open(url, '_blank', 'noopener,noreferrer');

            if (feedback) {
                feedback.textContent = 'O WhatsApp foi aberto em outra aba. Revise a mensagem e envie por lá.';
            }
        });
    }
});
