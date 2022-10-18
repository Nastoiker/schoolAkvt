const {form} = document.forms;
form.addEventListener("submit", ev);
// предотвращение многократной отправки данных формы
function ev (event) {
    event.preventDefault();
    const res = new FormData(form);
    const value = Object.fromEntries(res.entries());
    console.log(...res.values());
}
