//load JSON from a file 
fetch('js/cities.json')
    .then(response => response.json())
    .then(data => {
      //parse the JSON data into a js object
      const options = data;

      //get select element
      const select = document.getElementById('state');

      //Generate the select options dynamically
      options.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.value = option.name;
        optionElement.textContent = option.name;
        //optionElement.textContent += ", " +option.country;
        select.appendChild(optionElement);
      });

      //Event listener forselection changes
      select.addEventListener('change', event => {
        const selectedValue = event.target.value;
        const selectedOption = options.find(option => option.code === selectedValue);
        console.log('selected city:', selectedOption);
      });
    })

    .catch(error => console.error('Errors:', error));