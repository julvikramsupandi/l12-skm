import { AnswerOption } from "./answer_option"

export interface OptionScale {
    id: number
    code: string
    description: string
    answer_options: AnswerOption[]
}