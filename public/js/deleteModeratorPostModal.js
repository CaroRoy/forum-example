const openDeleteModal = document.getElementById('js-openModalDelete');
const deleteModal = document.getElementById('deletePostModeratorModal');
const closeDeleteModal = Array.from(document.querySelectorAll("[data-dismiss]"));
const containerPage = document.getElementById('containerPage');

if(openDeleteModal)
{
    openDeleteModal.addEventListener("click", function () {

        deleteModal.style.display = "initial";
        containerPage.style.opacity = "0.5";
    })
}

if(closeDeleteModal.length > 0)
{
    closeDeleteModal.forEach( (closeButton) => {
            closeButton.addEventListener("click", function() {
                if(deleteModal)
                {
                    deleteModal.style.display = "none";
                        containerPage.style.opacity = "1";
                }
            })
        }
    )
}