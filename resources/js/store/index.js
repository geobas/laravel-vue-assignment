import { createStore } from 'vuex';

function getTodoIndex(state, todo) {
    return state.todos.findIndex(item => item.id === todo.id);
}

export default createStore({
    state: {
        todos: [],
    },

    mutations: {
        setTodos(state, todos) {
            state.todos = todos;
        },

        completeAll({ todos }) {
            todos.forEach(todo => todo.done = true);
        },

        deleteTodo(state, todo) {
            state.todos.splice(getTodoIndex(state, todo), 1);
        },

        toggleTodo(state, todo) {
            state.todos[getTodoIndex(state, todo)].done = ! state.todos[getTodoIndex(state, todo)].done;
        },

        addTodo({ todos }, { body, id }) {
            todos.push({
                body,
                done: false,
                id: id
            });
        },
    },

    getters: {
        allCompleted(state) {
            return state.todos.every(todo => todo.done);
        }
    },

    actions: {
        // async fetchTodos({ commit }) {
        //     try {
        //         let result = await axios.get('/todos');
        //         commit('setTodos', result.data);
        //     } catch(error) {
        //         console.log('Error:', error.message);
        //     }
        // },

        fetchTodos({ commit }) {
            axios.get('/todos')
                .then(({ data }) => commit('setTodos', data))
                .catch(error => console.log('Error:', error.message));
        },

        addTodo({ commit }, body) {
            axios.post('/todos', {
                body: body,
                done: false
            })
                .then(({ data }) => commit('addTodo', { body: body, id: data.id }))
                .catch(error => console.log('Error:', error.message));
        },

        toggleTodo({ commit }, todo) {
            axios.put(`/todos/${todo.id}`)
                .then(() => commit('toggleTodo', todo))
                .catch(error => console.log('Error:', error.message));
        },

        completeAll({ commit }) {
            axios.put('/todos/complete')
                .then(() => commit('completeAll'))
                .catch(error => console.log('Error:', error.message));
        },

        deleteTodo({ commit }, todo) {
            axios.delete(`/todos/${todo.id}`)
                .then(() => commit('deleteTodo', todo))
                .catch(error => console.log('Error:', error.message));
        },
    }
});
