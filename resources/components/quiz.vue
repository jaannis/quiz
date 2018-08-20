<template>
	<div>
		Hello there.
		<br>
		Choose your quiz

		<select v-model="activeQuizId">
			<option v-for="quiz in allQuizzes" :value="quiz.id"> {{ quiz.name }}</option>
		</select>
		<br>
		What's your name?
		<input v-model="name"/>

		<button @click="onStart">Start</button>
	</div>
</template>
<script>
    import {mapActions} from 'vuex';

    export default {
        name: 'quiz',
        computed: {
            name: {
                get() {
                    return this.$store.state.name;
                },
                set(newName) {
                    this.setName(newName);
                }
            },
            activeQuizId: {
                get() {
                    return this.$store.state.activeQuizId;
                },
                set(newValue) {
                    this.setActiveQuizId(newValue);
                }
            },
            allQuizzes: {
                get() {
                    return this.$store.state.allQuizzes
                }
            }
        },
        methods: Object.assign({}, mapActions([
                'setAllQuizzes',
                'setActiveQuizId',
                'setName',
                'start',
            ]),
            {
                onStart() {
                    if (!this.name) {
                        alert('Give me your name');
                        return;
                    }
                    if (!this.activeQuizId) {
                        alert('Pick a quiz!');
                        return;
                    }
                    this.start();
                }
            }),

        created() {
            this.setAllQuizzes();
        }
    }
</script>