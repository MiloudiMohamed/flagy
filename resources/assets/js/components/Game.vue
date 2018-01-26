<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Information</div>
                    <div class="panel-body">
                        <div class="text-center" v-if="!finished">
                            <!-- <h2 class="text-center">Time out</h2> -->
                            <i class="fa fa-clock-o fa-3x"></i>
                            <h4 class="">{{ delay }}</h4>
                        </div v-if="!finished">
                        <div class="well" v-if="correct !== null">
                            <p class="">You have {{ correct }} of {{ options.flagsNumber }} correct answer!</p>
                            <p class="">You earned {{ earned }} points.</p>
                        </div>
                        <hr>
                        <div class="progress">
                          <div class="progress-bar progress-bar-success progress-bar-striped active"
                                role="progressbar"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                :style="progress"
                            >
                            {{ progressPercentage }}%
                          </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Game</div>
                    <div class="panel-body">

                        <div class="text-center text-primary" v-if="loading === true">
                            <i class="fa fa-spinner fa-pulse fa-spin fa-5x"></i>
                        </div>
                        <div>
                            <div class="col-md-6 col-md-offset-3" v-if="flags !== null && loading === false && !finished">
                                <img class="flag img-responsive img-thumbnail center-block" :src="selected()[0].path" alt="Flag">
                                <label>Suggestions:</label>
                                <ul class="list-group">
                                    <a v-for="(flag, index) in flags"
                                        href="#"
                                        class="list-group-item"
                                        :name="flag.key"
                                        @click.prevent="select"
                                        >
                                        {{ flag.name }}
                                    </a>
                                </ul>

                                <div v-if="!finished">
                                    <button class="btn btn-primary btn-block" @click="nextFlag">Confirm</button>
                                </div>
                            </div>
                        </div>

                        <div class="text-center" v-if="finished">
                            <h3>Congratulation, you've finished the game.</h3>
                            <span class="help-block">Click the button below to reveal your result </span>
                            <router-link class="btn btn-default" :to="{ path: '/game' }" @click.native="getResult" >
                                <i class="fa fa-eye"></i>&nbsp; Show my result
                            </router-link>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-warning" @click="restart">
                            <i class="fa fa-repeat"></i>&nbsp; Restart
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                played: 0,
                answer: [],
                chosen: '',
                options: {
                    difficulty: {
                        'speed': 7,
                        'suggestions': 4
                    },
                    flagsNumber: 5
                },
                flags: null,
                correct: null,
                loading: true,
                interval: null,
                delay: 7,
                alreadyPlayed: false
            }

        },

        mounted() {
            if (Object.keys(this.$route.params).length !== 0) {
                this.options = this.$route.params
            }
            this.delay = this.options.difficulty.speed


            this.getQuestion()
        },

        computed: {
            progress() {
                return 'width: ' + this.progressPercentage + '%'
            },

            progressPercentage() {
                return Math.floor((this.played * 100) / this.options.flagsNumber)
            },

            finished() {
                return this.played >= this.options.flagsNumber
            },

            earned () {
                if (this.correct == this.options.flagsNumber) {
                    return (this.correct + (this.correct / 2 )) * 10
                }
                return  this.correct * 10
            }
        },
        methods: {
            timer() {
                this.interval = setInterval(() => {
                    if (this.delay === 0 ) {
                        this.nextFlag()
                        return
                    }
                    return this.delay--
                }, 1000)
            },

            getQuestion() {
                this.loading = true
                axios.get('flags', {
                    params: {
                        take: this.options.difficulty.suggestions
                    }
                    }).then((response) => {
                    this.flags = response.data
                    this.loading = false
                    this.delay = this.options.difficulty.speed
                    this.timer()
                }).catch((e) =>  {
                    console.log(e)
                })
            },

            selected() {
                return this.flags.filter((flag) => {
                    return flag.selected === true
                })
            },

            nextFlag() {
                clearInterval(this.interval)
                console.log(this.interval)
                if (this.finished) {
                    return
                }
                this.played++
                this.answer.push({
                    "taken": this.chosen,
                    "correct": this.selected()[0].key
                })
                this.getQuestion()
            },

            select(e) {
                $('a.list-group-item').removeClass('activeClass')
                e.target.classList.add('activeClass')
                this.chosen = e.target.name
            },

            getResult() {
                if (this.alreadyPlayed === true) {
                    return
                }
                axios.post('/flags/result', { params: this.answer }).then((response) => {
                    this.correct = response.data
                    this.alreadyPlayed = true
                }).then((response) => {
                    axios.post('score/store', {
                        'options': this.options,
                        'correct': this.correct
                    }).then((response) => {
                        console.log(response.data)

                    })
                })
            },

            restart () {
                clearInterval(this.interval)
                this.$router.replace({ name: 'difficulty'})
            }
        }
    }
</script>

<style scoped>
    .flag {
        margin-bottom: 20px;
    }

    .activeClass {
        background: tomato!important;
        color: #fff!important;
    }
</style>
