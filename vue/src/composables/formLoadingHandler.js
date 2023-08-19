export const submitStarted = (form) => {
    form.value.node.context.state.loading = true;
    form.value.node.context.disabled = true;
};

export const submitFinished = (form) => {
    delete form.value.node.context.state.loading;
    form.value.node.context.disabled = false;
};
