document.getElementById('sectionId').addEventListener('change', function(){
  document.getElementById('sectionName').textContent = document.getElementById('sectionId').selectedOptions[0].getAttribute('data-name');
})