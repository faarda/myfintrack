(function(){
	const table = document.getElementById("records-table-body");
	const pagination = document.getElementById("pagination");
	const path = entryType == "s" ? "/spendings" : "earnings";

	function rowTemplate(num, description, amount, date){
		return `
            	<td>${num}</td>
            	<td>${description}</td>
            	<td>₦${formatNumber(amount)}</td>
            	<td>${formatDate(date)}</td>`;
	}

	function formatNumber(num) {
  		return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
	}

	function formatDate(date) {
		const months = ["Jan", "Feb", "Mar","Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		let realDate = new Date(date);

		console.log(realDate);
		var hours = realDate.getHours();
	  	var ampm = hours >= 12 ? 'PM' : 'AM';
	  	hours = hours % 12;
	  	hours = hours ? hours : 12;

		return realDate.getFullYear() + " " + months[realDate.getMonth()] + "-" + realDate.getDate() + " " + hours + ":" + realDate.getMinutes() + ":" + realDate.getSeconds() + " " + ampm;
	}

	function addNewRecords(data, start) {
		let toInsert = "";
		table.innerHTML = "";
		data.forEach( function(element, index) {
			console.log(element);
			toInsert = rowTemplate(start, element.description, element.amount, element.created_at);
			let div = document.createElement('tr');

			div.innerHTML = toInsert;
			table.appendChild(div);
			start++;
		});

	}

	pagination.addEventListener('click', function(e){

		el = e.target;

		if(e.target.classList.contains("pag-link")){
			let pagLink = e.target;

			let count = pagLink.dataset.start;

			fetch(path + `/${count}`) 
			.then(function(res) {
			    return res.json();
			})
			.then(function(data){
				let begin = (count * 10) - 10 + 1;
				addNewRecords(data, begin);
				document.querySelector(".pag-link.active").classList.remove('active');
				e.target.classList.add('active');
				document.getElementById('shown').innerHTML = `${data.length > 0 ? begin + " - " + (begin + data.length - 1) : 0}`;
			})
			.catch(function(err) {
				console.log(err);
			    alert("Sorry something went wrong!")
			});

		}
	});

})();