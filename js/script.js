var inventoryModal = document.getElementById('all__inventory__model')
var inventoryInput = document.getElementById('all__inventory__modelBtn')

inventoryModal.addEventListener('shown.bs.modal', function () {
  inventoryInput.focus()
})