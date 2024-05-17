const albmus = document.getElementById("albmus")
const photos = document.getElementById("photos")
const AddAlbum = () => {
    albmus.classList.toggle("active")
    albmus.classList.toggle("hidden")
}

const AddPhoto = () => {
    photos.classList.toggle("active")
    photos.classList.toggle("hidden")
}

const DeleteAlbum = (id) => {
    const radio = document.getElementById(id);
    radio.classList.toggle("active")
    radio.classList.toggle("hidden")
}
const dropdown = (id) => {
    const lis = document.getElementById(id);
    lis.classList.toggle("active")
    lis.classList.toggle("hidden")
}
const edit = (id) => {
    const edit = document.getElementById(id);
    
    edit.classList.toggle("active")
    edit.classList.toggle("hidden")
}

