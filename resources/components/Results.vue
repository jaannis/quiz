<template>
	<div v-if="result" class="text-center">
		<div>
			<h1>
				Thanks {{name}}!
			</h1>
			<h2>
				{{ result }}
			</h2>
		</div>

		<div>
			<button class="btn btn-lg btn-primary btn-block" @click="restart">Start again</button>
		</div>
	</div>
</template>
<script>
    import {mapActions} from 'vuex';

    export default {
        name: 'Results',
        computed: {
            result: {
                get() {
                    return this.$store.state.result;
                }
            },
            name: {
                get() {
                    return this.$store.state.name;
                }
            },

        },
        methods: mapActions(['restart']),
    }
</script>