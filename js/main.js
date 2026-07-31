// Kitchen Notes JavaScript Engine (Vanilla JS)
// ICT 1209 Required Features: Dynamic Content Filtering, Form Validation, Dynamic Fields

document.addEventListener('DOMContentLoaded', () => {

    // 1. Live Recipe Search & Filter Chips (Wireframe 1 & 2)
    const searchInput = document.getElementById('recipeSearchInput');
    const filterChips = document.querySelectorAll('.filter-chip');
    const recipeCards = document.querySelectorAll('.recipe-card-item');

    if (searchInput) {
        searchInput.addEventListener('keyup', (e) => {
            const query = e.target.value.toLowerCase().trim();
            recipeCards.forEach(card => {
                const title = card.getAttribute('data-title')?.toLowerCase() || '';
                const category = card.getAttribute('data-category')?.toLowerCase() || '';
                if (title.includes(query) || category.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    if (filterChips.length > 0) {
        filterChips.forEach(chip => {
            chip.addEventListener('click', function() {
                filterChips.forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                const selectedCategory = this.getAttribute('data-category');
                recipeCards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    if (selectedCategory === 'All' || cardCat === selectedCategory) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // 2. Dynamic Field Addition (+ Add Ingredients & + Add Step for Wireframe 3)
    const addIngredientBtn = document.getElementById('addIngredientBtn');
    const ingredientsContainer = document.getElementById('ingredientsContainer');

    if (addIngredientBtn && ingredientsContainer) {
        addIngredientBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.className = 'input-group mb-2 dynamic-item-row';
            div.innerHTML = `
                <input type="text" name="ingredients[]" class="form-control" placeholder="e.g. 1 tsp Olive Oil" required>
                <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-solid fa-trash"></i></button>
            `;
            ingredientsContainer.appendChild(div);
        });
    }

    const addStepBtn = document.getElementById('addStepBtn');
    const stepsContainer = document.getElementById('stepsContainer');

    if (addStepBtn && stepsContainer) {
        addStepBtn.addEventListener('click', () => {
            const count = stepsContainer.querySelectorAll('.dynamic-item-row').length + 1;
            const div = document.createElement('div');
            div.className = 'input-group mb-2 dynamic-item-row';
            div.innerHTML = `
                <span class="input-group-text">Step ${count}</span>
                <input type="text" name="instructions[]" class="form-control" placeholder="Describe this cooking step..." required>
                <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-solid fa-trash"></i></button>
            `;
            stepsContainer.appendChild(div);
        });
    }

    // Event Delegation for Removal of Dynamic Rows
    document.addEventListener('click', (e) => {
        if (e.target.closest('.remove-row-btn')) {
            e.target.closest('.dynamic-item-row').remove();
        }
    });

    // 3. Real-time Form Validation (Registration & Login & Contact)
    const validateForms = document.querySelectorAll('.needs-js-validation');
    validateForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const inputs = form.querySelectorAll('[required]');
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }

                if (input.type === 'email') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(input.value)) {
                        isValid = false;
                        input.classList.add('is-invalid');
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please correct the highlighted errors before submitting.');
            }
        });
    });

});
