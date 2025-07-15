document.addEventListener('DOMContentLoaded', function () {
    const editorContent = document.getElementById('editorContent');
    const editorToolbar = document.getElementById('editorToolbar');
    const hiddenContentInput = document.getElementById('hiddenContentInput');
    const form = editorContent.closest('form');

    if (!editorContent || !editorToolbar || !hiddenContentInput || !form) {
        console.error('One or more editor elements not found.');
        return;
    }

    // Fungsi untuk menjalankan perintah formatting
    function applyCommand(command, value = null) {
        // Fokuskan editor agar perintah berlaku pada seleksi saat ini
        editorContent.focus();
        try {
            if (value) {
                document.execCommand(command, false, value);
            } else {
                document.execCommand(command, false, null);
            }
        } catch (e) {
            console.error('Error executing command:', command, e);
        }
    }

    // Event listener untuk tombol toolbar
    editorToolbar.addEventListener('click', function (event) {
        const target = event.target.closest('.tool-btn, .tool-select'); // Tangkap tombol atau select

        if (target) {
            const command = target.dataset.command;

            if (command) {
                if (command === 'createLink' || command === 'insertImage') {
                    const promptText = target.dataset.prompt || 'Enter value:';
                    const value = prompt(promptText);
                    if (value) {
                        applyCommand(command, value);
                    }
                } else if (command === 'formatBlock') {
                    // Untuk select box, nilai sudah ada di event.target.value
                    if (target.tagName === 'SELECT') {
                         applyCommand(command, target.value);
                    }
                } else {
                    applyCommand(command);
                }
            }
        }
    });

    // Event listener untuk select box (khususnya untuk formatBlock)
    editorToolbar.addEventListener('change', function(event) {
        const target = event.target;
        if (target.tagName === 'SELECT' && target.dataset.command) {
            applyCommand(target.dataset.command, target.value);
        }
    });

    // Sebelum form disubmit, isi input hidden dengan konten HTML dari editor
    form.addEventListener('submit', function (event) {
        hiddenContentInput.value = editorContent.innerHTML;
        // console.log("Konten yang dikirim:", hiddenContentInput.value); // Untuk debugging
    });

    // Optional: Untuk menunjukkan status tombol (bold/italic aktif)
    // Ini lebih kompleks dan membutuhkan pemantauan selectionchange atau keyup/mouseup
    // Anda bisa mengimplementasikannya dengan document.queryCommandState() atau Range API.
    // Contoh sederhana:
    editorContent.addEventListener('keyup', updateToolbarState);
    editorContent.addEventListener('mouseup', updateToolbarState); // Untuk seleksi mouse
    editorContent.addEventListener('focus', updateToolbarState);

    function updateToolbarState() {
        const buttons = editorToolbar.querySelectorAll('.tool-btn');
        buttons.forEach(button => {
            const command = button.dataset.command;
            if (command && ['bold', 'italic', 'underline', 'strikeThrough', 'insertUnorderedList', 'insertOrderedList'].includes(command)) {
                try {
                    if (document.queryCommandState(command)) {
                        button.classList.add('active');
                    } else {
                        button.classList.remove('active');
                    }
                } catch (e) {
                    // Some commands might not have a state, ignore errors
                }
            }
        });

        // Update selected option for formatBlock
        const formatSelect = editorToolbar.querySelector('select[data-command="formatBlock"]');
        if (formatSelect) {
            const currentBlock = document.queryCommandValue('formatBlock');
            if (currentBlock && formatSelect.querySelector(`option[value="${currentBlock}"]`)) {
                 formatSelect.value = currentBlock;
            } else {
                 formatSelect.value = 'p'; // Default to paragraph
            }
        }
    }

    // Panggil sekali saat dimuat untuk set state awal
    updateToolbarState();
});