export const forgotPasswordReq = async (payload) =>
    await axiosClient.post("forgot-password", payload);
