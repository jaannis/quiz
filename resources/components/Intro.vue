<template>
	<div v-if="!activeQuestion && !result">

		<div>
			<label>Your name</label>
			<input type="text" v-model="name"/>
		</div>

		<div>
			<label>Pick your quiz</label>
			<select v-model="activeQuizId">
				<option v-for="quiz in allQuizzes" :value="quiz.id">{{ quiz.name }}</option>
			</select>
		</div>

		<div>
			<button @click="onStart">Start</button>
		</div>
	</div>
</template>

<script>
    import {mapActions} from 'vuex';
    export default {
        name: 'Intro',
        computed: {
            allQuizzes: {
                get() {
                    return this.$store.state.allQuizzes
                }
            },
            activeQuestion: {
                get() {
                    return this.$store.state.activeQuestion;
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
            result: {
                get() {
                    return this.$store.state.result;
                }
            },
            name: {
                get() {
                    return this.$store.state.name;
                },
                set(newName) {
                    this.setName(newName);
                }
            },
        },
        methods: Object.assign({}, mapActions([
            'setAllQuizzes',
            'setActiveQuizId',
            'setName',
            'start',
        ]), {
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
            },
            getQuizzes() {
                return [].concat([{id: '', name: '---'}], this.allQuizzes.map(quiz => quiz.toArray()));
            }
        }),
        created() {
            this.setAllQuizzes();
        }
    }
</script>