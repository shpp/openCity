/*!
 * FileInput Russian Translations
 *
 * This file must be loaded after 'fileinput.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-fileinput
 * @author CyanoFresh <cyanofresh@gmail.com>
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
(function ($) {
    "use strict";

    $.fn.fileinputLocales['ua'] = {
        fileSingle: 'файл',
        filePlural: 'файли',
        browseLabel: 'Вибрати &hellip;',
        removeLabel: 'Видалити',
        removeTitle: 'Очистити обрані файли',
        cancelLabel: 'Відміна',
        cancelTitle: 'Відмінити поточне завантаження',
        uploadLabel: 'Завантажити',
        uploadTitle: 'Завантажити обрані файли',
        msgNo: 'ні',
        msgNoFilesSelected: '',
        msgCancelled: 'Відмінено',
        msgZoomModalHeading: 'Детальне превью',
        msgSizeTooSmall: 'Файл "{name}" (<b>{size} KB</b>) дуже малий і має бути не менше than <b>{minSize} KB</b>.',
        msgSizeTooLarge: 'Файл "{name}" (<b>{size} KB</b>) перевищує максимальний размір <b>{maxSize} KB</b>.',
        msgFilesTooLess: 'Ви повинні вибрати як мінімум <b> {n} </ b> {files} для завантаження.',
        msgFilesTooMany: 'Кількість вибраних файлів <b> ({n}) </ b> перевищує максимально допустиму кількість <b> {m} </ b>.',
        msgFileNotFound: 'Файл "{name}" не знайдено!',
        msgFileSecured: 'Обмеження безпеки забороняють читати файл "{name}".',
        msgFileNotReadable: 'Файл "{name}" неможливо прочитати.',
        msgFilePreviewAborted: 'Попередній перегляд скасований для файлу "{name}".',
        msgFilePreviewError: 'Сталася помилка при читанні файлу "{name}".',
        msgInvalidFileName: 'Недійсні або не підтримуються символи в імені файлу "{name}".',        
        msgInvalidFileType: 'Заборонений тип файлу для "{name}". Тільки "{types}" дозволені. ',
        msgInvalidFileExtension: 'Заборонене розширення для файлу "{name}". Тільки "{extensions}" дозволені. ',
        msgFileTypes: {
            'image': 'image',
            'html': 'HTML',
            'text': 'text',
            'video': 'video',
            'audio': 'audio',
            'flash': 'flash',
            'pdf': 'PDF',
            'object': 'object'
        },
        msgUploadAborted: 'Вивантаження файлу перервано',
        msgUploadThreshold: 'Обробтка...',
        msgValidationError: 'Помилка перевірки',
        msgLoading: 'Загрузка файла {index} из {files} &hellip;',
        msgProgress: 'Загрузка файла {index} из {files} - {name} - {percent}% завершено.',
        msgSelected: 'Выбрано файлов: {n}',
        msgFoldersNotAllowed: 'Разрешено перетаскивание только файлов! Пропущено {n} папок.',
        msgImageWidthSmall: 'Ширина изображения {name} должна быть не меньше {size} px.',
        msgImageHeightSmall: 'Высота изображения {name} должна быть не меньше {size} px.',
        msgImageWidthLarge: 'Ширина изображения "{name}" не может превышать {size} px.',
        msgImageHeightLarge: 'Высота изображения "{name}" не может превышать {size} px.',
        msgImageResizeError: 'Не удалось получить размеры изображения, чтобы изменить размер.',
        msgImageResizeException: 'Ошибка при изменении размера изображения.<pre>{errors}</pre>',
        msgAjaxError: 'Something went wrong with the {operation} operation. Please try again later!',
        ajaxOperations: {
            deleteThumb: 'file delete',
            uploadThumb: 'single file upload',
            uploadBatch: 'batch file upload',
            uploadExtra: 'form data upload'
        },
        dropZoneTitle: 'Перетяніть файли сюди &hellip;',
        dropZoneClickTitle: '<br>(Або клікніть, щоб обрати {files})',
        fileActionSettings: {
            removeTitle: 'Видалити файл',
            uploadTitle: 'Завантажити файл',
            zoomTitle: 'подивитись деталі',
            dragTitle: 'Перемістити / Перегрупувати',
            indicatorNewTitle: 'Ще не завантажено',
            indicatorSuccessTitle: 'Завантажено',
            indicatorErrorTitle: 'Помилка завантаження',
            indicatorLoadingTitle: 'Завантаження ...'
        },
        previewZoomButtonTitles: {
            prev: 'Подивитись попередній файл',
            next: 'Подивитись наступний файл',
            toggleheader: 'Toggle header',
            fullscreen: 'Toggle full screen',
            borderless: 'Toggle borderless mode',
            close: 'Close detailed preview'
        }
    };
})(window.jQuery);
