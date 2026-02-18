let field = document.counterForm.amount;

function increment(amount) {
    value = parseInt(field.value);
    value += amount;
    field.value = value;
}