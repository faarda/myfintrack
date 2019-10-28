(function(){
    const addEntriesBtn = document.getElementById("add-entries");
    const createEntries = document.querySelector(".create-entries");
    const closeEntriesBtn = document.querySelector(".close-entries");
    const entryForms = document.querySelector(".entry-forms");
    const addItem = document.getElementById("add-item");
    const usePresetBtn = document.getElementById("use-presets");
    const presetItems = ["Groceries", "Electricity", "Cable", "Transportation"];
    let token = document.head.querySelector('meta[name="csrf-token"]').content;
    let path = entryType == 's' ? '/spendings' : '/earnings';
    let createdEntries = 0;
    let savedEntries = {};

    function entryTemplate(entryId, preset){
        return `<form data-id="${entryId}" data-type="create"><div class="entry-form" id="entry-form-${entryId}">
            <span class="entry-id">#${entryId}</span>
            <div class="input-1">
                <input type="text" required id="description-${entryId}" value="${preset == null ? '' : preset}" class="form-input" name="description" placeholder="item/description">
            </div>
            <div class="input-2">
                <input type="number" required name="amount" id="amount-${entryId}" class="form-input" placeholder="amount">
            </div>
            <div class="entry-btn">
                <button class="save-item btn btn-sm btn-ascent" id="submit-${entryId}"><span data-feather="check"></span></button>
            </div>
        </div></form>`;
    }

    function successNotificationTemplate(id, type) {
        return `<div class="notification notification-success" id="notif-${id}">
                        Record has been ${type == "create" ? "saved" : "updated"}
                        <p class="notification-action">
                            <span class="text-link edit-entry" data-id="${id}">Edit</span> &nbsp;&nbsp; | &nbsp;&nbsp;
                            <span class="text-link delete-entry" data-id="${id}">Delete</span>
                        </p>
                    </div>`;
    }

    function deleteNotificationTemplate(id) {
        return `<div class="notification notification-error" id="notif-${id}">
                        Record has been deleted  
                    </div>`;
    }

    function addEntries(preset = null){
        createdEntries++;
        let entry = document.createElement('div');
        let template = entryTemplate(createdEntries, preset);
        entry.innerHTML = template;

        entryForms.appendChild(entry);
    }

    addEntriesBtn.addEventListener('click', function () {
        createEntries.style.display = "block";
        
        for(i=0; i < 2; i++){
            addEntries();
        }

        feather.replace();
    });
    
    addItem.addEventListener('click', function(e){
        addEntries();
        feather.replace();

        e.preventDefault();
    });

    closeEntriesBtn.addEventListener('click', function () {
        if (confirm("Do you want to close entries? All unsaved records would be lost.")) {
            createEntries.style.display = "none";
            createdEntries = 0;
            entryForms.innerHTML = "";
        }
    });

    usePresetBtn.addEventListener('click', function(e){
        if(confirm('This would remove all unsaved entries, do you want to proceed?')){
            entryForms.innerHTML = "";
            createdEntries = 0;
            let count = presetItems.length;

            for(i=0; i < count; i++){
                addEntries(presetItems[i]);
            }
    
            feather.replace();
        }

        e.preventDefault();
    });


    entryForms.addEventListener('submit', function(e){
        e.preventDefault();
        
        let form = e.target;
        let id = form.dataset.id;
        let type = form.dataset.type;

        clearErrors(id);

        let description = document.getElementById("description-"+id).value;
        let amount = document.getElementById("amount-"+id).value;
        let method, newPath;

        let data = {
            'description': description,
            'amount': amount
        }

        if(type == "create"){           
            method = "POST";
            newPath = path;
        }else if (type == "update"){
            method = "PUT";
            newPath = path + `/${savedEntries[id]['id']}`;
        }

        fetch(newPath, {
            method: method,
            headers : new Headers({
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }),
            body:JSON.stringify(data)
        }).then((res) => {
            let status = res.status;
            if(status == 200){
                return res.json();
            }else if (status == 422){
                errorHandler(res.json(), id);
            }else{
                alert("Sorry something went wrong!")
            }
        }).then(data => {
            // console.log(data);
            if(typeof data !== 'undefined' && data.status == 'saved'){
                savedEntries[id] = {
                    'id': data.id,
                    'description': description,
                    'amount': amount  
                }
                showSuccess(id, type);
            }
        }).catch(err => {
            console.log(err);
        });
    });

    entryForms.addEventListener('click', function(e){
        let clickedEl = e.target;

        if(Array.from(clickedEl.classList).indexOf("edit-entry") !== -1){
            let id = e.target.dataset.id;

            let thisForm = document.querySelector(`form[data-id="${id}"]`);
            let thisEntryForm = document.getElementById("entry-form-"+id);
            let thisNotification = document.getElementById(`notif-${id}`);

            thisNotification.remove();
            thisEntryForm.style.display = 'flex';
            thisForm.dataset.type = "update";

        }else if(Array.from(clickedEl.classList).indexOf("delete-entry") !== -1){
            let id = e.target.dataset.id;
            let dbId = savedEntries[id]['id'];

            if(confirm("Are you sure you want to remove this record?")){
                let thisNotification = document.getElementById(`notif-${id}`);

                thisNotification.remove();
                fetch(path + `/${dbId}`, {
                    method: 'DELETE',
                    headers : new Headers({
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    })
                }).then((res) => {
                    let status = res.status;
                    if(status == 200){
                        return res.json();
                    }
                }).then(data => {
                    if(typeof data !== 'undefined' && data.status == 'deleted'){
                        showSuccess(id, "delete");
                    }
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    });

    function showSuccess(id, type){
        let thisForm = document.querySelector(`form[data-id="${id}"]`);
        let thisEntryForm = document.getElementById("entry-form-"+id);

        let notif = document.createElement('div');
        notif.innerHTML = type == "delete" ? deleteNotificationTemplate(id) : successNotificationTemplate(id, type);
        thisForm.appendChild(notif);
        thisEntryForm.style.display = "none";
        setTimeout(function(){
            document.getElementById("notif-"+id).style.display = 'none'; 
        }, 30000)
    }

    function errorHandler(err, id) {
        err.then(error => {
            let errors = error.errors;

            Object.entries(errors).forEach( function(el) {
                let fieldName = el[0];
                let fieldError = el[1][0];

                let toAppend;
                if(fieldName == "amount"){
                    toAppend = "input-2";
                }else{
                    toAppend = "input-1";
                }

                let errorText = document.createElement("span");
                errorText.className = "error-text";
                errorText.innerHTML = fieldError;

                document.getElementById(fieldName + "-" + id).classList.add('error');
                document.querySelector(`#entry-form-${id} .${toAppend}`).appendChild(errorText);

                console.log(fieldError, fieldName);
            });
        })
    }

    function clearErrors(id){
        let inputs = document.querySelectorAll(`#entry-form-${id} .error`);
        let texts = document.querySelectorAll(`#entry-form-${id} .error-text`);

        if(inputs.length > 0){            
            Array.from(inputs).forEach( function(element, index) {
                element.classList.remove('error');
            });
        }

        if(texts.length > 0){            
            Array.from(texts).forEach( function(element, index) {
                element.remove();
            });
        }
    }
})();