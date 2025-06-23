// JS for profile tab switching and section toggling

document.addEventListener('DOMContentLoaded', function () {
    const tabBtns = document.querySelectorAll('.profile-tab-btn');
    const sections = {
        'profile-info': document.getElementById('profile-info-section'),
        'password': document.getElementById('password-section'),
        'delete': document.getElementById('delete-section'),
        'competences': document.getElementById('competences-section'),
        'diplomes': document.getElementById('diplomes-section'),
    };
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            Object.keys(sections).forEach(key => {
                sections[key].style.display = (this.dataset.tab === key) ? 'block' : 'none';
            });
        });
    });
});

// JS for diplome section: toggle new etab fields and add countries
function toggleEtabFields(val) {
    const fields = document.getElementById('new-etab-fields');
    if (val === 'new') {
        fields.style.display = 'flex';
        fields.querySelectorAll('input,select').forEach(i => {
            if (i.name !== 'etablissement_telephone') i.required = true;
        });
    } else {
        fields.style.display = 'none';
        fields.querySelectorAll('input,select').forEach(i => {
            i.required = false;
        });
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const countries = [
        "Afghanistan","Albania","Algeria","Andorra","Angola","Argentina","Armenia","Australia","Austria","Azerbaijan",
        "Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia",
        "Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cabo Verde","Cambodia","Cameroon",
        "Canada","Central African Republic","Chad","Chile","China","Colombia","Comoros","Congo (Congo-Brazzaville)","Costa Rica","Croatia",
        "Cuba","Cyprus","Czechia (Czech Republic)","Democratic Republic of the Congo","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt",
        "El Salvador","Equatorial Guinea","Eritrea","Estonia","Eswatini (fmr. Swaziland)","Ethiopia","Fiji","Finland","France","Gabon",
        "Gambia","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana",
        "Haiti","Holy See","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland",
        "Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Kuwait","Kyrgyzstan",
        "Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Madagascar",
        "Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia",
        "Moldova","Monaco","Mongolia","Montenegro","Morocco","Mozambique","Myanmar (formerly Burma)","Namibia","Nauru","Nepal",
        "Netherlands","New Zealand","Nicaragua","Niger","Nigeria","North Korea","North Macedonia","Norway","Oman","Pakistan",
        "Palau","Palestine State","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar",
        "Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia",
        "Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa",
        "South Korea","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Sweden","Switzerland","Syria","Tajikistan",
        "Tanzania","Thailand","Timor-Leste","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu",
        "Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Venezuela","Vietnam",
        "Yemen","Zambia","Zimbabwe"
    ];
    const paysSelect = document.getElementById('etablissement_pays');
    if (paysSelect) {
        countries.forEach(function(country) {
            let option = document.createElement('option');
            option.value = country;
            option.text = country;
            paysSelect.appendChild(option);
        });
    }
    const etabSelect = document.getElementById('etablissement_select');
    if (etabSelect) {
        etabSelect.addEventListener('change', function() {
            toggleEtabFields(this.value);
        });
        // Call once on page load to set correct state
        toggleEtabFields(etabSelect.value);
    }
});
