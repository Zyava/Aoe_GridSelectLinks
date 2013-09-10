/**
 * @author Dmytro Zavalkin <dimzav@gmail.com>
 */

varienGridMassaction.prototype.getNotGreenCheckboxesValues = function () {
    var result = [];
    this.getCheckboxes().each(function (checkbox) {
        if ($(checkbox).up(1).select('span.grid-severity-critical').length > 0
            || $(checkbox).up(1).select('span.grid-severity-minor').length > 0
        ) {
            result.push(checkbox.value);
        }
    }.bind(this));
    return result;
};
varienGridMassaction.prototype.getNotGreenCheckboxesValuesAsString = function () {
    return this.getNotGreenCheckboxesValues().join(',');
};
varienGridMassaction.prototype.selectNotGreen = function () {
    this.setCheckedValues(this.getNotGreenCheckboxesValuesAsString());
    this.checkCheckboxes();
    this.updateCount();
    this.clearLastChecked();
    return false;
};
varienGridMassaction.prototype.unselectNotGreen = function () {
    this.getNotGreenCheckboxesValues().each(function (key) {
        this.checkedString = varienStringArray.remove(key, this.checkedString);
    }.bind(this));
    this.checkCheckboxes();
    this.updateCount();
    this.clearLastChecked();
    return false;
};
