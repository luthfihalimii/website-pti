<script>
const logoInput = document.getElementById('logoInput');
const previewContainer = document.getElementById('previewContainer');
const logoType = document.getElementById('logoType');
const nameContainer = document.getElementById('nameContainer');
const nameInputs = document.getElementById('nameInputs');

logoInput.addEventListener('change', function () {
    previewContainer.innerHTML = '';
    nameInputs.innerHTML = '';

    const files = Array.from(this.files);

    files.forEach((file, index) => {
        const reader = new FileReader();

        reader.onload = function (e) {
            const wrapper = document.createElement('div');
            wrapper.className = 'flex flex-col gap-2';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'h-24 w-24 object-contain border rounded p-2 bg-white';

            wrapper.appendChild(img);
            previewContainer.appendChild(wrapper);
        };

        reader.readAsDataURL(file);

        if (logoType.value !== 'pti') {
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'name[]';
            input.placeholder = 'Nama untuk ' + file.name;
            input.className = 'w-full rounded-xl border border-slate-300 px-3 py-2 text-sm';

            nameInputs.appendChild(input);
        }
    });
});

logoType.addEventListener('change', function () {
    if (this.value === 'pti') {
        nameContainer.style.display = 'none';
        logoInput.multiple = false;
        nameInputs.innerHTML = '';
    } else {
        nameContainer.style.display = 'block';
        logoInput.multiple = true;
    }
});

window.addEventListener('load', function () {
    if (logoType.value === 'pti') {
        nameContainer.style.display = 'none';
        logoInput.multiple = false;
    }
});
</script>