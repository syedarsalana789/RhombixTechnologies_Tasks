
const newTaskInput = document.getElementById('new-task');
const addTaskButton = document.getElementById('add-task');
const taskList = document.getElementById('task-list');

let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

function saveTasks() {
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

function displayTasks() {
    taskList.innerHTML = '';
    tasks.forEach((task, index) => {
        const taskItem = document.createElement('li');
        taskItem.classList.add('task-item');
        
        const taskText = document.createElement('span');
        taskText.textContent = task.text;
        taskText.contentEditable = true;
        taskText.addEventListener('blur', () => {
            tasks[index].text = taskText.textContent;
            saveTasks();
        });

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', () => {
            tasks.splice(index, 1);
            saveTasks();
            displayTasks();
        });

        taskItem.appendChild(taskText);
        taskItem.appendChild(deleteButton);
        taskList.appendChild(taskItem);
    });
}


function addTask() {
    const taskText = newTaskInput.value.trim();
    if (taskText) {
        tasks.push({ text: taskText });
        saveTasks();
        displayTasks();
        newTaskInput.value = '';
    }
}


addTaskButton.addEventListener('click', addTask);
newTaskInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        addTask();
    }
});

displayTasks();
