<template>

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Difficulty</div>
            <div class="panel-body">
                <label for="">Please choose the difficulty</label>
                <div class="row">
                    <div class="col-md-4">
                        <label class="radio-inline">
                          <input type="radio" name="difficulty" id="easy" :value='{ "speed": 10, "suggestions": 2 }' v-model="options.difficulty">
                          <strong class="text-success">Easy</strong>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="radio-inline">
                          <input type="radio" name="difficulty" id="normal" :value='{ "speed": 7, "suggestions": 4 }' v-model="options.difficulty" >
                          <strong class="text-primary">Normal</strong>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="radio-inline">
                          <input type="radio" name="difficulty" id="hard" :value='{ "speed": 4, "suggestions": 6 }' v-model="options.difficulty">
                          <strong class="text-danger">Hard</strong>
                        </label>
                    </div>
                </div><br>

                <div class="alert alert-info" v-if="Object.keys(options.difficulty).length">
                    <div v-if="difficulty === 'easy'">
                        <strong>Dumpers choices.</strong>
                        <ul>
                            <li>10 seconds timeout.</li>
                            <li>2 suggestions.</li>
                        </ul>
                    </div>
                    <div v-if="difficulty === 'normal'">
                        <strong>Normal users.</strong>
                        <ul>
                            <li>7 seconds timeout.</li>
                            <li>4 suggestions.</li>
                        </ul>
                    </div>
                    <div v-if="difficulty === 'hard'">
                        <strong>Pro users.</strong>
                        <ul>
                            <li>4 seconds timeout.</li>
                            <li>6 suggestions.</li>
                        </ul>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-6">
                        <label>Choose how many flag to answer for:</label>
                        <select name="flagsNumber" class="form-control" v-model="options.flagsNumber">
                            <option value="1">1 flag</option>
                            <option value="3">3 flags</option>
                            <option value="5">5 flags</option>
                            <option value="10">10 flags</option>
                            <option value="15">15 flags</option>
                            <option value="20">20 flags</option>
                        </select>
                    </div>

                </div>

                <hr>
                <div class="form-group">
                    <router-link class="btn btn-primary btn-block" :to="{ name: 'game', params: this.options }">
                        <i class="fa fa-play"></i> start now
                    </router-link>
                </div>


            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                options: {
                    difficulty: {
                        'speed': 7,
                        'suggestions': 4
                    },
                    flagsNumber: 5
                }
            }
        },

        computed: {
            difficulty () {
                if (this.options.difficulty.speed ===  10) {
                    return 'easy'
                }

                if (this.options.difficulty.speed ===  7) {
                    return 'normal'
                }

                if (this.options.difficulty.speed ===  4) {
                    return 'hard'
                }
            }
        }

    }
</script>
