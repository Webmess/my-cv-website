function toggleMenu() {
    const menu = document.querySelector(".menu-links");
    const icon = document.querySelector(".hamburger-icon");
    menu.classList.toggle("open");
    icon.classList.toggle("open");
}

// Function to create, update, and delete personal info items
const personalInfoItems = document.querySelectorAll('.personal-info-container');

personalInfoItems.forEach(item => {
    const editBtn = document.createElement('button');
    editBtn.textContent = 'Edit';
    
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';

    item.appendChild(editBtn);
    item.appendChild(deleteBtn);

    editBtn.addEventListener('click', () => {
        const updatedInfo = prompt('Update personal info details (e.g., title, description):');
        if (updatedInfo !== null && updatedInfo.split(',').length === 2) {
            item.querySelector('h3').textContent = updatedInfo.split(',')[0];
            item.querySelector('p').textContent = updatedInfo.split(',')[1];
        } else {
            alert('Please enter information in the correct format.');
        }
    });

    deleteBtn.addEventListener('click', () => {
        item.remove();
    });
});

// Function to create, update, and delete contact info items
const contactInfoItems = document.querySelectorAll('.contact-info-upper-container .contact-info-container');

contactInfoItems.forEach(item => {
    const editBtn = document.createElement('button');
    editBtn.textContent = 'Edit';
    
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';

    item.appendChild(editBtn);
    item.appendChild(deleteBtn);

    editBtn.addEventListener('click', () => {
        const updatedContact = prompt('Update contact info details (e.g., contact type, details):');
        if (updatedContact !== null && updatedContact.split(',').length === 2) {
            item.querySelector('a').textContent = updatedContact.split(',')[0];
            item.querySelector('a').setAttribute('href', updatedContact.split(',')[1]);
        } else {
            alert('Please enter information in the correct format.');
        }
    });

    deleteBtn.addEventListener('click', () => {
        item.remove();
    });
});
 // Function to create, update, and delete experience items
const experienceItems = document.querySelectorAll('.experience-container');

experienceItems.forEach(item => {
    const editBtn = document.createElement('button');
    editBtn.textContent = 'Edit';
    
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';

    item.appendChild(editBtn);
    item.appendChild(deleteBtn);

    editBtn.addEventListener('click', () => {
        const updatedExperience = prompt('Update experience details (e.g., job title, description):');
        if (updatedExperience !== null && updatedExperience.split(',').length === 2) {
            item.querySelector('h3').textContent = updatedExperience.split(',')[0];
            item.querySelector('p').textContent = updatedExperience.split(',')[1];
        } else {
            alert('Please enter information in the correct format.');
        }
    });

    deleteBtn.addEventListener('click', () => {
        item.remove();
    });
});

// Function to create, update, and delete education items
const educationItems = document.querySelectorAll('.education-container');

educationItems.forEach(item => {
    const editBtn = document.createElement('button');
    editBtn.textContent = 'Edit';
    
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';

    item.appendChild(editBtn);
    item.appendChild(deleteBtn);

    editBtn.addEventListener('click', () => {
        const updatedEducation = prompt('Update education details (e.g., degree title, institution):');
        if (updatedEducation !== null && updatedEducation.split(',').length === 2) {
            item.querySelector('h3').textContent = updatedEducation.split(',')[0];
            item.querySelector('p').textContent = updatedEducation.split(',')[1];
        } else {
            alert('Please enter information in the correct format.');
        }
    });

    deleteBtn.addEventListener('click', () => {
        item.remove();
    });
});