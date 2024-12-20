<?php
    /**
     * Upload any file by using do_upload() method
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
?>
