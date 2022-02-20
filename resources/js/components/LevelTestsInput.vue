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
                <tr v-for="row in rows_count">
                    <td style="position: relative; padding: 0;" v-for="col in (inputs.length + outputs.length)">
                        <label
                            style="position: absolute; width: 100%; height: 100%"
                            :for="getCheckboxName(row, col)"
                        ></label>
                        <input class="m-3" type="checkbox" :name="getCheckboxName(row, col)" :id="getCheckboxName(row, col)">

                    </td>
                </tr>
                </tbody>
            </table>

            <a href="#" class="btn-secondary btn btn-sm" v-on:click.prevent="rows_count++">Добавить тест</a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            inputs: [],
            outputs: [],
            rows_count: 0
        }
    },
    methods: {
        getCheckboxName(row, col) {
            return "tests[" + row + "][" + col + "]"
        },
        switchCheckbox(row, col) {
            document.getElementById(this.getCheckboxName(row, col)).checked = !document.getElementById(this.getCheckboxName(row, col)).checked;
        }
    }
}
</script>
