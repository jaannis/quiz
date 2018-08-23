<template>
	<div v-if="!activeQuestion && !result" class="text-center">

		<div class="margin__needed">
			<h1>Quiz</h1>
		</div>
		<div class="margin__needed">
			<input class="form-control" type="text" v-model="name" placeholder="Your name"/>
		</div>

		<div class="margin__needed">
			<select class="form-control" v-model="activeQuizId">
				<option disabled> -- Pick your quiz --</option>
				<option v-for="quiz in allQuizzes" :value="quiz.id">{{ quiz.name }}</option>
			</select>
		</div>

		<div>
			<button class="btn btn-lg btn-primary btn-block"  @click="onStart">Start</button>
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
        data () {
            return {
                activeQuizId: "-- Pick your quiz --"
            }
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