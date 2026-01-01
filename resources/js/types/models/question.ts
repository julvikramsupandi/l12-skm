import { OptionScale } from "./option_scale";

export interface Question {
    id: number
    element_id: number
    question_code: string
    question_text: string
    option_scale: OptionScale
}