<template>
    <div>
        <div class="form-group mt-3">
            <label for="inputs">Входы</label>
            <tags-input wrapper-class="form-control" placeholder=""
                        element-id="inputs" v-model="inputs"></tags-input>
        </div>

        <div class="form-group mt-3">
            <label for="outputs">Выходы</label>
            <tags-input wrapper-class="form-control" placeholder=""
                        element-id="outputs" v-model="outputs"></tags-input>
        </div>

        <div class="form-group mt-3">
            <label>Тесты</label>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr v-if="inputs.length + outputs.length > 0">
                        <th class="col" v-for="input in inputs">{{ input.value }}</th>
                        <th class="col" v-for="output in outputs">{{ output.value }}</th>
                    </tr>
                    <tr v-else>
                        <th class="col">
                            Добавьте входы и выходы
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="row in rowsCount">
                        <td style="position: relative; padding: 0;" v-for="col in (inputs.length + outputs.length)">
                            <input type="hidden" value="off" :name="getCheckboxName(row, col)">

                            <label
                                style="position: absolute; width: 100%; height: 100%"
                                :for="getCheckboxName(row, col)"
                            ></label>
                            <input class="m-3" type="checkbox" :name="getCheckboxName(row, col)"
                                   :id="getCheckboxName(row, col)" v-model="tests[row - 1][col - 1]">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <a href="#" class="btn-secondary btn btn-sm" v-on:click.prevent="addTest">Добавить тест</a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        inputsValue: Array,
        outputsValue: Array,
        testsValue: Array
    },
    data() {
        return {
            inputs: [],
            outputs: [],
            tests: [],
            rowsCount: 0,
        }
    },
    methods: {
        getCheckboxName(row, col) {
            if (col - 1 < this.inputs.length)
                return "test_inputs[" + (row - 1) + "][" + this.inputs[col - 1].value + "]"

            return "test_outputs[" + (row - 1) + "][" + this.outputs[col - this.inputs.length - 1].value + "]"
        },
        switchCheckbox(row, col) {
            this.tests[row - 1][col - 1] = !this.tests[row - 1][col - 1]
        },
        addTest() {
            this.tests[this.rowsCount] = [];
            this.rowsCount++;
        }
    },
    beforeMount() {
        this.inputs = this.inputsValue
        this.outputs = this.outputsValue

        this.tests = this.testsValue
        this.rowsCount = this.tests.length
    }
}
</script>
