import { describe, it, expect, beforeEach } from 'vitest';
import store from '@/store/index.js';

describe ('Todo store', () => {
    beforeEach (() => {
        store.state.todos = [
            { body: "dummy", done: true, id: 1},
            { body: "akis", done: false, id: 2},
            { body: "testakis", done: true, id: 3}
        ];
    });

    it ('defaults to three todos', () => {
        expect(store.state.todos).to.not.be.empty;
        expect(store.state.todos).to.have.lengthOf(3);
    });

    it ('creates a todo', () => {
        store.commit('addTodo', { body: "foo", id: 4});
        expect(store.state.todos).to.not.be.empty;
        expect(store.state.todos).to.have.lengthOf(4);
        expect(store.state.todos[3].body).to.be.equal('foo');
    });

    it ('deletes a todo', () => {
        store.commit('deleteTodo');
        expect(store.state.todos).to.have.lengthOf(2);
    });

    it ('completes all todos', () => {
        store.commit('completeAll');
        expect(store.state.todos[1].done).to.be.true;
    });

    it ('checks if all todos are completed', () => {
        expect(store.getters.allCompleted).toBe(false);
        store.commit('completeAll');
        expect(store.getters.allCompleted).toBe(true);
    });
});
