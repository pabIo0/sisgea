document.addEventListener('DOMContentLoaded', function() {
    // 1. Elementos de Senha Original
    const passwordInput = document.getElementById('senha');
    const bar = document.getElementById('password-strength-bar');
    const feedback = document.getElementById('password-feedback');

    // 2. Elementos de Confirmação de Senha
    const confirmInput = document.getElementById('senha_confirmation');
    const confirmBar = document.getElementById('password-confirmation-bar');
    const confirmFeedback = document.getElementById('password-confirmation-feedback');

    // 3. Botão de Submissão
    const registerButton = document.getElementById('register-button');

    const minLength = 6;
    let isPasswordValid = false;
    let isConfirmationValid = false;

    // --- FUNÇÕES DE VERIFICAÇÃO ---

    /**
     * Verifica e atualiza a barra de força da senha original.
     */
    function checkPasswordStrength() {
        if (!passwordInput || !bar || !feedback) return;

        const password = passwordInput.value;
        let percentage = Math.min((password.length / minLength) * 100, 100);

        bar.style.width = percentage + '%';

        if (password.length >= minLength) {
            isPasswordValid = true;
            bar.classList.remove('bg-red-500');
            bar.classList.add('bg-emerald-500');
            feedback.textContent = 'Senha válida!';
            feedback.classList.remove('text-slate-500', 'text-red-600');
            feedback.classList.add('text-emerald-600');
        } else {
            isPasswordValid = false;
            bar.classList.add('bg-red-500');
            bar.classList.remove('bg-emerald-500');
            feedback.textContent = 'Mínimo de 6 caracteres';
            feedback.classList.remove('text-emerald-600', 'text-red-600');
            feedback.classList.add('text-slate-500');
        }

        // Após alterar a senha, sempre checa a confirmação e o botão
        checkPasswordConfirmation();
        updateRegisterButton();
    }

    /**
     * Verifica se a Confirmação de Senha corresponde à senha original.
     */
    function checkPasswordConfirmation() {
        if (!passwordInput || !confirmInput || !confirmBar || !confirmFeedback) return;

        const password = passwordInput.value;
        const confirmation = confirmInput.value;
        const areEqual = password === confirmation && confirmation.length > 0;

        let percentage = confirmation.length > 0 ? 100 : 0;
        confirmBar.style.width = percentage + '%';

        if (areEqual) {
            isConfirmationValid = true;
            confirmBar.classList.remove('bg-red-500');
            confirmBar.classList.add('bg-emerald-500');
            confirmFeedback.textContent = 'As senhas coincidem!';
            confirmFeedback.classList.remove('text-slate-500', 'text-red-600');
            confirmFeedback.classList.add('text-emerald-600');
        } else if (confirmation.length > 0) {
            isConfirmationValid = false;
            confirmBar.classList.add('bg-red-500');
            confirmBar.classList.remove('bg-emerald-500');
            confirmFeedback.textContent = 'As senhas não coincidem.';
            confirmFeedback.classList.remove('text-slate-500', 'text-emerald-600');
            confirmFeedback.classList.add('text-red-600');
        } else {
            isConfirmationValid = false;
            confirmBar.classList.remove('bg-red-500', 'bg-emerald-500');
            confirmFeedback.textContent = '';
            confirmBar.style.width = '0%';
            confirmFeedback.classList.remove('text-emerald-600', 'text-red-600');
            confirmFeedback.classList.add('text-slate-500');
        }

        // Atualiza o estado do botão
        updateRegisterButton();
    }

    /**
     * Habilita/Desabilita o botão de cadastro.
     */
    function updateRegisterButton() {
        if (!registerButton) return;

        // Condições mínimas: Senha Original válida E Senha de Confirmação válida
        const canSubmit = isPasswordValid && isConfirmationValid;

        if (canSubmit) {
            registerButton.disabled = false;
            registerButton.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            registerButton.disabled = true;
            registerButton.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }


    // --- EVENT LISTENERS ---

    if (passwordInput) {
        passwordInput.addEventListener('input', checkPasswordStrength);
    }

    if (confirmInput) {
        confirmInput.addEventListener('input', checkPasswordConfirmation);
    }

    // Inicia a validação ao carregar a página (caso haja campos pré-preenchidos)
    checkPasswordStrength();
    checkPasswordConfirmation();
    updateRegisterButton();
});
