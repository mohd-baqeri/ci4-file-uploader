# ci4-file-uploader
Upload all kinds of data using the do_upload() method.

*Note:* Copy the code below and paste it on your Controller class. and use it like:

    $uploaded_file_name = $this->do_upload('file_name', 'images', ['jpg', 'jpeg', 'png']);

*Code:* method to be copied.

    /**
     * Upload any file by using the do_upload() method
     * @param string $fileName
     * @param string $path
     * @param array $fileExt = ['png', 'jpg', 'jpeg'] // or anything you can overwrite these
     * @return string $newFileName
     */
    public function do_upload($fileName, $path, $fileExt = ['png', 'jpg', 'jpeg'])
    {
        $file = $this->request->getFile($fileName);
        if (is_array($fileExt)) {
            if (!in_array($file->getExtension(), $fileExt)) {
                return 'ext_error';
            }
        } else {
            if ($file->getExtension() !== $fileExt) {
                return 'ext_error';
            }
        }

        $newFileName = $fileName . time() . '-' . rand(1, 100) . '.' . $file->getExtension();

        $file->move(ROOTPATH . 'assets/' . $path . '/', $newFileName);

        return $newFileName;
    }
